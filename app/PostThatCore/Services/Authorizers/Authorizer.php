<?php namespace PostThatCore\Services\Authorizers;

use Cartalyst\Sentry\Sentry;

abstract class Authorizer {

	protected $perm;
	protected $resource;
	protected $user;

	function __construct($perm, $resource, $user = null)
	{
		$this->perm 	= $perm;
		$this->resource = $resource;
		$this->user 	= $user ?: Sentry::getUser();

	}

	public function passes()
	{
		// do i have a hook?
		// did it pass?
		// return true
		$action = explode('.', $this->perm);
		if (method_exists($this, $action[1] . 'Hook'))
		{
			return $this->{$action[1] . 'Hook'}();
		}
		
		// do i have the perm?
		return $this->user->hasAccess($this->perm);
	}
}

