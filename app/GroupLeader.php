<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupLeader extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'group_leader';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'group_id', 
		'user_id'
	];
}
