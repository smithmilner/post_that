<?php namespace Authz\Repo\Profile;

interface ProfileInterface {

	public function create($data);

	public function update($id, $data);

	public function destroy($id);

	public function find($id);

	public function findByLinkedIn($memberId);

	public function all();

}
