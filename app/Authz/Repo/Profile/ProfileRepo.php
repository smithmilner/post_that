<?php namespace Authz\Repo\Profile;

use Authz\Repo\BaseRepo;
use Authz\Models\Profile;

 class ProfileRepo extends BaseRepo implements  ProfileInterface {

	public function create($data)
	{
		return new Profile($data);
	}

	public function update($id, $data)
	{
		$profile = Profile::find($id);
		$profile->update($data);
		return $profile;
	}

	public function destroy($id)
	{
		return Profile::destroy($id);
	}

	public function find($id)
	{
		return Profile::find($id);
	}

	public function findByLinkedIn($memberId)
	{
		return Profile::where('linkedinId', '=', $memberId)->first();
	}

	public function all()
	{
		return Profile::all();
	}

}
