<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
	 * A group has exactly one destination
	 * 
	 * @return [type] [description]
	 */
	public function destination()
	{
		return $this->belongsTo('App\Destination');
	}

	/**
	 * A group can have many users
	 * 
	 * @param string $value [description]
	 */
	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
