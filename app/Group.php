<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App;
use DB;

class Group extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'groups';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'destination_id', 
		'date', 
		'slots'
	];

	protected $dates = ['date'];

	/**
	 * Mutator.. transforms from date to Carbon
	 * 
	 * @param [type]
	 */
	public function setDateAttribute($date)
	{
		$this->attributes['date'] = Carbon::parse($date);
	}

	public function getDateAttribute($date)
	{
		return new Carbon($date);
	}

    /**
     * @param $query
     * @param $userId
     */
    public function scopeIsMember($query, $userId)
    {
    	$users = $this->users;
    	foreach ($users as $user) 
    	{
    		if ($user->id == $userId)
    		{
    			return 1;
    		}
    	}

    	return -1;
    }

    /**
     * Used to filter the groups by date..
     * @param $query
     * @param $destination_id
     */
	public function scopeMyDestination($query, $destination_id)
	{
        return $query->where('destination_id', '=', $destination_id);
	}

    /**
     * Used to filter the groups by date..
     * @param $query
     * @param $date
     */
	public function scopeMyDate($query, $date)
	{
        return $query->where('date', '>=', Carbon::parse($date)->startOfDay())
                     ->where('date', '<=', Carbon::parse($date)->endOfDay()) ;
	}

    /**
     * Used to filter the groups by slots..
     * @param $query
     * @param $tickets
     */
	public function scopeEnoughSlots($query, $tickets)
	{
        return $query->where('slots', '>=', $tickets);
	}

    /**
     * A group has exactly one destination
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function destination()
	{
		return $this->belongsTo('App\Destination');
	}

    /**
     * A group can have many users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function users()
	{
		return $this->belongsToMany('App\User');
	}

	/**
	 * A group can have many comments
	 * 
	 * @return [type] [description]
	 */
	public function comments()
	{
		return $this->hasMany('App\Comment')->latest();
	}
}
