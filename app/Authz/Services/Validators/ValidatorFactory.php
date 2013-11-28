<?php namespace Authz\Services\Validators;

use Closure;

class ValidatorFactory {

	protected $app;

	protected $validators = array();

	public function __construct($app)
	{
		$this->app = $app;
	}

	public function make($type, $input = null)
	{
		if ($this->validators[$type])
		{
			$v = $this->fetchValidator($type, $input);

			if ($v instanceof ValidatorInterface)
			{

				return $v;

			}
			else {

				throw new Exception("Validator $type doesn't implement ValidatorInterface");

			}
		}
		else {

			throw new Exception("Invalid Validator Type Request");

		}
	}

	protected function fetchValidator($type, $input)
	{
		$callback = $this->validators[$type];

		if ($callback instanceof Closure)
		{
			return call_user_func_array($callback, array($input));
		}
		elseif(is_string($callback))
		{
			return $this->callClassBasedExtension($callback, array($input));
		}
	}

	protected function callClassBasedExtension($callback, $parameters)
	{
		list($class, $method) = explode('@', $callback);

		return call_user_func_array(array($this->app->make($class), $method), $parameters);
	}

	/**
	 * Register Validator Types with the factory.
	 * @param  string $type
	 * @param  Closure|string $creator
	 * @return void
	 */
	public function register($type, $creator)
	{
		$this->validators[$type] = $creator;
	}

}
