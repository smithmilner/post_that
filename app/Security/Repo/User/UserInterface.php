<?php namespace Security\Repo\User;

interface UserInterface {

	public function store($data);

	public function update($id, $data);

	public function destroy($id);

	public function byId($id);

	public function all();

}
