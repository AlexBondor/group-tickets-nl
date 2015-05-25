<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use Guzzle\Http\Client as Guzzle;

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

    private $enable = false;

    /**
     * Create a new controller instance.
     *
     */
	public function __construct()
	{
		$this->middleware('auth');

		$this->user = Auth::user();
	}

    public function composeMessage()
    {
        if (Auth::user()->provider_id == getenv('ADMIN_ID'))
        {
            return view('admin.compose');
        }
        return view('errors.503');
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
    private function sort($my_groups)
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
        
        if(Request::ajax())
        {
            return $group->users->toArray();
        }
        
        $logged_user = $this->user;

        // If user is not a member of required groupId
		// then return error
		if($group && $group->isMember($logged_user->id) == -1)
        {
            return view('groups.joinable', compact('group', 'logged_user'));
        }
        if(!$group)
        {
            return view('errors.503');
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

        if($group->slots == 0)
        {
            $this->notifyGroupFull($group);
        }

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
        // In Safari input max is not working.. so user might set
        // more tickets than group has available
        if ($group->slots - $request->tickets >= 0)
        {
            $group->slots -= $request->tickets;
            $group->save();
            return view('errors.503');
        }

        if($group->slots == 0)
        {
            $this->notifyGroupFull($group);
        }

        session()->flash('joined_group_message', 'You joined the group!');

        return redirect('groups');
    }

    public function notifyGroupFull($group)
    {
        $users = $group->users;
        $callback = "/groups/" . $group->id;

        $message = $group->destination->name . " - " . $group->date->format('d/m/y') . " group is FULL!";
        $access_token = getenv('FACEBOOK_CLIENT_ID') . "|" . getenv('FACEBOOK_CLIENT_SECRET');

        // Alert each member of the group that current
        // user has done something:D
        foreach ($users as $user) 
        {
            $url =  "https://graph.facebook.com/" . $user->provider_id . 
                "/notifications?access_token=" . $access_token .
                "&template=" . $message .
                "&href=" . $callback;
            $client = new Guzzle($url);
            $client->post()->send();
        }
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

        DB::table('comments')->whereRaw('group_id = ? AND user_id = ?', [$group->id, $this->user->id])->delete();
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

    /**
     * Listen if until something changes in group
     * @return [type] [description]
     */
    public function listen($groupId)
    {
        $response = new Symfony\Component\StreamedResponse(function() {
            //$old_comments = array();
            $old_slots = 10;
            while(true)
            {
                $group = Group::find($groupId);
                $new_slots = $group->slots;
                if ($old_slots != $new_slots)
                {
                    echo 'data: ' . json_encode($new_slots) . "\n\n";
                    ob_flush();
                    flush();
                }
                sleep(3);
                $old_slots = $new_slots;
            }
        });
        
        $response->headers->set('Content-Type', 'text/event-stream');
        return $response;
    }

    /**
     * Notify the users when something changed in a group
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function notifyUsers()
    {
        if ($this->enable)
        {
            $group_id = Request::get('group_id');
            $callback = Request::get('callback');
            $action = Request::get('action');
            $group = Group::find($group_id);
            $users = $group->users;
            $tickets = 10 - $group->slots;

            $message = $this->user->name . " has " . $action . " [" . $tickets . "/10]" . $group->destination->name . " - " . $group->date->format('d/m/y') . " group.";
            $access_token = getenv('FACEBOOK_CLIENT_ID') . "|" . getenv('FACEBOOK_CLIENT_SECRET');

            // Alert each member of the group that current
            // user has done something:D
            foreach ($users as $user) 
            {
                if($user->provider_id != $this->user->provider_id)
                {
                    $url =  "https://graph.facebook.com/" . $user->provider_id . 
                        "/notifications?access_token=" . $access_token .
                        "&template=" . $message .
                        "&href=" . $callback;
                    $client = new Guzzle($url);
                    $client->post()->send();
                }
            }
        }        
    }
}
