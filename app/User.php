<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'provider_id', 
		'name', 
		'email', 
		'avatar', 
		'link'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 
		'remember_token'
	];

	/**
	 * A user can be part of more groups
	 * 
	 * @return [type] [description]
	 */
	public function groups()
	{
		return $this->belongsToMany('App\Group')->withPivot('tickets')->withTimestamps();
	}

	/**
	 * Returns the number of tickets a user has requested for specific group
	 * 
	 * @param  [type] $groupId [description]
	 * @return [type]          [description]
	 */
	public function tickets($groupId)
	{
		return  DB::table('group_user')->whereRaw('group_id = ? AND user_id = ?', array($groupId, $this->id))->pluck('tickets');
	}

	/**
	 * A user can make more comments
	 * 
	 * @return [type] [description]
	 */
	public function comments()
	{
		return $this->hasMany('App\Comment');
	}
}
