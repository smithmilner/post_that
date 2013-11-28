<?php namespace Authz\Services\Validators;

class Session extends Validator {

	/**
	 * Required variables to create a user
	 *
	 * @var array
	 */
	protected $rules = [
		'username' => 'required|between:3,24',
		'password' => 'required|alpha_num|min:5',
	];

	public function getRules()
	{
		return $this->rules;
	}
}

