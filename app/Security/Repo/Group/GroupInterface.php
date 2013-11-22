<?php namespace Security\Repo\Group;

interface GroupInterface {

	public function store($data);

	public function update($id);

	public function destroy($id);

	public function byId($id);

	public function byName($name);

	public function all();

}
