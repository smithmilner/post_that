<?php namespace Authz\Services\Validators;

abstract class Validator implements ValidatorInterface {

	protected $attributes;

	public $errors;

	public function __construct($attributes = null)
	{
		$this->attributes = $attributes ?: \Input::all();
	}

	public function passes()
	{
		$v = \Validator::make($this->attributes, $this->getRules());

		if ($v->passes()) return true;

		$this->errors = $v->messages();

		return false;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}