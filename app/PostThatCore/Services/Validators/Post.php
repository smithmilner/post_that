<?php namespace PostThatCore\Services\Validators;

use Authz\Services\Validators\Validator;

class Post extends Validator {

	/**
	 * Required variables to create a post
	 *
	 * @var array
	 */
	static $rules = [
		'title' => 'required',
	];

}