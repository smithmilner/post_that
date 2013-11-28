<?php namespace Authz\Models;


use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Eloquent as Eloquent;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Model attributes allowed to be mass assigned.
	 * @var array
	 */
	protected $fillable = array('username', 'email', 'password');

	/**
	 * Model attributes protected from mass assignment.
	 * @var array
	 */
	protected $guarded = array('id', 'password');

	/**
	 * Factory
	 */
	public static $factory = array(
		'username' => 'string',
		'email' => 'email',
		'password' => 'password'
	);

	public function posts()
	{
		return $this->hasMany('Post');
	}

	public function flags()
	{
		return $this->hasMany('Flag');
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Finds the username for the suppied user.
	 * @param  int  $user_id
	 * @return  string
	 */
	public static function getUserName($user_id)
	{
		$user = User::find($user_id);

		if (is_null($user)) {

			$username = 'anonymous';

		} else {

			$username = $user->username;

		}

		return ucwords($username);
	}

	// public function beforeSave() {
	// 	// if there's a new password, hash it
	// 	if($this->isDirty('password')) {
	// 		$this->password = Hash::make($this->password);
	// 	}

	// 	return true;
	// }

}