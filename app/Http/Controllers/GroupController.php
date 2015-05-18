<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

use App\Group;
use App\Destination;
use App\Comment;
use DB;
use View;

use Carbon\Carbon;

class GroupController extends Controller {

	private $user;

    /**
     * Create a new controller instance.
     *
     */
	public function __construct()
	{
		$this->middleware('auth');

		$this->user = Auth::user();
	}

    /**
     * Display groups that user belongs to
     * 
     * @return \Illuminate\View\View [type] [description]
     */
	public function index()
	{
		$my_groups = $this->user->groups;

        // If user hasn't joined o groups yet
        if ($my_groups->isEmpty())
        {
            return view('errors.no-groups');
        }

        $my_groups = $this->sort($my_groups);

		return view('groups.index', compact('my_groups'));
	}

    /**
     * Sort groups after date and name
     * 
     * @param  [type] $my_groups [description]
     * @return [type]            [description]
     */
    private function sort ($my_groups)
    {
        // Transform Collection to Array
        // Create date and name arrays used for sorting
        foreach ($my_groups as $key => $group) 
        {
            $my_array[$key] = $group;
            $date[$key]  = $group['date'];
            $name[$key] = $group->destination->name;
        }

        array_multisort($date, SORT_ASC, $name, SORT_ASC, $my_array);

        return $my_array;
    }

	/**
	 * Display details of a specific group
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function show($slug)
	{
        $url = explode("-", $slug);
        $groupId = $url[0];

		$group = Group::find($groupId);
        
        $logged_user = $this->user;

        // If user is not a member of required groupId
		// then return error
		if(!$group || $group->isMember($logged_user->id) == -1)
        {
            return view('groups.joinable', compact('group', 'logged_user'));
        }

		return view('groups.show', compact('group', 'logged_user'));
	}	

	/**
     * Save a new group
     *
     * @param  SearchRequest $request
     * @return static
     */
	public function createGroup(CreateGroupRequest $request)
	{
        $group_id = $this->checkIfJustCreated($request);

        // If no group found or is already joined
        if($group_id == -1)
        {   
            // Create a new group
            $group = Group::create([
                    'destination_id' => $request->destination_id,
                    'date' => $request->date,
                    'slots' => 10 - $request->tickets
                ]);

            // Continue group creation procedure
            // Update group_user table
            $this->syncGroupUsers($group->id, $request->tickets);

            session()->flash('created_group_message', 'New group created!');

            return redirect('groups');
        }
        else
        {
            // Create a join group request
            $parameters = array (
                'group_id' => $group_id,
                'tickets' => $request->tickets,
            );

            $joinGroupRequest = UpdateGroupRequest::create('', 'GET', $parameters);

            return $this->joinGroup($joinGroupRequest);
        }
	}

    /**
     * Return -1 if nobody just created or there is one but already joined
     * Return $group->id if smb just created a group
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    private function checkIfJustCreated($request)
    {
        // Search for group just in case somebody just created it
        $group = Group::myDestination($request->destination_id)
                        ->myDate($request->date)
                        ->enoughSlots($request->tickets)
                        ->first();
        // If still no group
        if(!$group)
        {
            return -1;
        }
        else
        {
            // If there is a group but I have already joined it
            if($group->isMember($this->user->id) == 1)
            {
                return -1;
            }
        }
        return $group->id;
    }

    /**
     * Updates the tickets given by a user
     * 
     * @param  UpdateGroupRequest $request [description]
     * @return [type]                      [description]
     */
    public function updateGroup(UpdateGroupRequest $request)
    {
        if(Request::ajax())
        {
            $tickets = Request::get('tickets');
            $group_id = Request::get('group_id');
        }
        else
        {
            $tickets = $request->tickets;
            $group_id = $request->group_id;
        }

        $group = Group::find($request->group_id);

        // If the user is a member of the group already
        if(!$group || $group->isMember($this->user->id) == -1)
        {
            return view('errors.503');
        }

        $old_tickets = $this->user->tickets($group->id);

        // In Safari input max is not working.. so user might set
        // more tickets than group has available
        if ($tickets - $old_tickets > $group->slots)
        {
            if(Request::ajax())
            {
                return [$old_tickets, 10 - $group->slots];
            }
            else
            {
                return $this->show($group->id);
            }
        }

        $this->syncGroupUsers($group_id, $tickets);

        // Update tickets available for group
        $group->slots += $old_tickets - $tickets;
        $group->save();

        if(Request::ajax())
        {
            return [$tickets, 10 - $group->slots];
        }
        else
        {
            return $this->show($group->id);
        }
    }

    /**
     * Joins a group if the user is not a member of it already
     * 
     * @param $groupId
     * @param $tickets
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @internal param $request
     */
    public function joinGroup(UpdateGroupRequest $request)
    {
        $group = Group::find($request->group_id);

        // If the user is a member of the group already
        if(!$group || $group->isMember($this->user->id) == 1)
        {
            return view('errors.503');
        }
        $this->syncGroupUsers($request->group_id, $request->tickets);

        // Update tickets available for group
        
        $group->slots -= $request->tickets;
        $group->save();

        session()->flash('joined_group_message', 'You joined the group!');

        return redirect('groups');
    }

    /**
     * Fired when user wants to leave a group
     * 
     * @param  LeaveGroupRequest $request [description]
     * @return [type]                     [description]
     */
    public function leaveGroup(UpdateGroupRequest $request)
    {
        $group = Group::find($request->group_id);

        // If the user is not a member of the group
        if(!$group || $group->isMember($this->user->id) == -1)
        {
            return view('errors.503');
        }

        DB::table('group_user')->whereRaw('group_id = ? AND user_id = ?', [$group->id, $this->user->id])->delete();

        // Update tickets available for the group

        $group->slots += $request->tickets;
        
        if($group->slots == 10)
        {
            $group->delete();
        }
        else
        {
            $group->save();
        }

        session()->flash('left_group_message', 'You have left the group!');

        return redirect('groups');
    }

    /**
     * Sync up the group_users table in the database.
     *
     * @param $groupId
     * @param $tickets
     * @internal param $group
     * @internal param Article $article
     * @internal param array $tags
     */
	private function syncGroupUsers($groupId, $tickets)
	{
		// Get users' other groups
		$my_groups = $this->user->groups->lists('id');

		// Append current group id to users' groups
		$my_groups[$groupId] = ['tickets' => $tickets];

		// Link new group to user
        $this->user->groups()->sync($my_groups);
	}

    /**
     * Add a new comment to group
     * 
     * @param [type] $request [description]
     */
    public function addComment()
    {
        $group_id = Request::get('group_id');
        $comment = Request::get('comment');

        $group = Group::find($group_id);
        
        // Create the new group object
        $comment = Comment::create([
                    'group_id' => $group_id,
                    'user_id' => $this->user->id,
                    'text' => $comment
                ]);

        return View::make('groups._comments-list', compact('group'));
    }
}