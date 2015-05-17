<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'destinations';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 
		'slug', 
		'code'
	];

	/**
	 * A destination can be set to more groups
	 * 
	 * @return [type] [description]
	 */
	public function groups()
	{
		return $this->hasMany('App\Group');
	}
}