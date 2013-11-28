<?php namespace Authz\Services\Validators;

class User extends Validator {

	/**
	 * Required variables to create a user
	 *
	 * @var array
	 */
	protected $rules = [
		'username' => 'required|between:3,24',
		'email' => 'required|unique:users|email',
		'password' => 'required|alpha_num|min:5',
	];

	public function getRules()
	{
		return $this->rules;
	}
}
