<?php namespace Security\Services\Validators;

abstract class Validator {

	protected $attributes;

	public $errors;

	public function __construct($attributes = null)
	{
		$this->attributes = $attributes ?: \Input::all();
	}

	public function passes()
	{
		$v = \Validator::make($this->attributes, static::$rules);

		if ($v->passes()) return true;

		$this->errors = $v->messages();

		return false;
	}
}