<?php namespace Authz\Repo\User;

use Authz\Repo\BaseRepo;
use Authz\Models\User;

class UserRepo extends BaseRepo implements UserInterface {

	public function __construct()
	{

	}
	public function create($data)
	{
		$user = new User($data);
		return $user;
	}

	public function update($id, $data)
	{
		$user = User::find($id);
		$user->update($data);
		return $user;
	}

	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
	}

	public function find($id)
	{
		return User::find($id);
	}

	public function all()
	{
		return User::all();
	}

}
