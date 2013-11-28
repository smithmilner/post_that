<?php namespace Authz\Repo\User;

interface UserInterface {

	public function store($data);

	public function update($id, $data);

	public function destroy($id);

	public function find($id);

	public function all();

}
