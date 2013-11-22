<?php namespace Security\Repo\Session;

interface SessionInterface {

	public function store($data);

	public function destroy();

}