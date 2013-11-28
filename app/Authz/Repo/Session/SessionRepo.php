<?php namespace Authz\Repo\Session;

use Authz\Repo\BaseRepo;

class SessionRepo extends BaseRepo implements SessionInterface {

	protected $auth;

	public function __construct($auth)
	{
		$this->auth = $auth;
	}

	public function store($data = null, $remember = false)
	{
		$data = $data ?: \Input::all();
		return $this->auth->attempt($data, $remember);
	}

	public function login($data = null, $remember = false)
	{
		return $this->store($data, $remember);
	}

	public function destroy()
	{
		$this->auth->logout();
	}

	public function logout()
	{
		$this->destroy();
	}

	public function check()
	{
		return $this->auth->check();
	}

	public function user()
	{
		return $this->auth->user();
	}
}