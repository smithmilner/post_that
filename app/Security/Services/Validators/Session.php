<?php namespace Security\Services\Validators;

class Session extends Validator {
	/**
	 * Required variables to create a user
	 *
	 * @var array
	 */
	static $rules = [
		'username' => 'required|between:3,24',
		'password' => 'required|alpha_num|min:5',
	];
}

