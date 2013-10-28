<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface {

	public $autoHydrateEntityFromInput = true;

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
	 * Required variables to create a user
	 *
	 * @var array
	 */
	public static $rules = array(
		'username' => 'required|between:3,24',
		'email' => 'required|unique:users|email',
		'password' => 'required|alpha_num|min:5',
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

	public static function validateLogin($input)
	{
		return $v = Validator::make($input, array_except(self::$rules, array('email')));
	}

	/**
	 * Attempt a user login with the provided inputs.
	 *
	 * @param  array $input Login credentials
	 * @return mixed        A user object or false on failure.
	 */
	public static function login($input)
	{
		if (Auth::attempt($input)) {

			return Auth::user();

		} else {

			return false;

		}
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

	public function beforeSave() {
		// if there's a new password, hash it
		if($this->isDirty('password')) {
			$this->password = Hash::make($this->password);
		}

		// Clean username.
		if($this->isDirty('username')) {
			$this->username = HTML::entities($this->username);
		}

		return true;
	}

}