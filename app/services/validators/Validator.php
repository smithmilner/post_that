<?php namespace Services\Validators

abstract class Validator {

	protected $attributes;

	public $errors;

	public function __contruct($attributes = null)
	{
		$this->attributes = $attributes ?: Input::all();
	}

	public function passes()
	{
		$validation = \Validator::make($this->attributes, static::$rules);

		if ($validation->passes()) return TRUE;

		$this->errors = $validation->messages();

		return false;
	}
}