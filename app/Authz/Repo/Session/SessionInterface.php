<?php namespace Authz\Repo\Session;

interface SessionInterface {

	public function store($data);

	public function destroy();

	public function check();

}