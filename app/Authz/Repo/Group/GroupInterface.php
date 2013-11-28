<?php namespace Authz\Repo\Group;

interface GroupInterface {

	public function store($data);

	public function update($id, $data);

	public function destroy($id);

	public function byId($id);

	public function byName($name);

	public function all();

}
