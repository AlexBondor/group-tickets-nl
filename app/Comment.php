<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'group_id', 
		'user_id', 
		'text'
	];

	/**
	 * A comment is assigned to one group
	 * 
	 * @return [type] [description]
	 */
	public function group()
	{
		return $this->belongsTo('App\Group');
	}

	/**
	 * A comment is made by one user
	 * 
	 * @return [type] [description]
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
