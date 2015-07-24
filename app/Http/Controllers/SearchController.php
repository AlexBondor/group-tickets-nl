<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\SearchRequest;

use App\Destination;
use App\Group;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class SearchController extends Controller {

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
     * Display search view
     * @return \Illuminate\View\View
     */
	public function index()
	{
		$destinations = Destination::lists('name', 'id');

		asort($destinations);

        $default_id = Destination::where('slug', '=', 'anywhere')->first()->id;

		return view('search.index', compact('destinations', 'default_id'));
	}

    /**
     * Display the results matching the searched criteria
     *
     * @param  SearchRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show(SearchRequest $request)
    {
        $destination_id = $request->destination_list[0];
        
        if (Destination::find($destination_id)->slug == 'anywhere')
        {
            $builder = Group::myDate($request->date)
                             ->enoughSlots($request->tickets);
        }
        else
        {
            $builder = Group::myDestination($request->destination_list[0])
                             ->myDate($request->date)
                             ->enoughSlots($request->tickets);
        }

        // All results of searched query
        $results = $builder->get();

        $joined_groups = new Collection;
        foreach ($results as $result) 
        {
            if ($result->isMember($this->user->id) == 1)
            {
                $joined_groups->add($result);
            }
        }

        $new_groups = $results->diff($joined_groups);
        
        $tickets = $request->tickets;
        $date = $request->date;
        $destination_name = Destination::find($destination_id)->name;
        $logged_user = $this->user;
        $destination_slug = Destination::find($destination_id)->slug;

        $data = array(
            'tickets'=>$tickets,
            'destination_id'=>$destination_id,
            'date'=>$date,
            'destination_name'=>$destination_name,
            'logged_user'=>$logged_user,
            'destination_slug'=>$destination_slug
        );

        return view('search.results', compact('new_groups', 'joined_groups', 'data'));
    }

    /**
     * Display a list of FAQ
     * @return [type] [description]
     */
    public function faq()
    {
        return view('search.faq');
    }
}
