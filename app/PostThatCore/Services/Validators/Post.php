<?php namespace PostThatCore\Services\Validators;

use Security\Services\Validators\Validator;

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