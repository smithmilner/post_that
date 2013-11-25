<?php namespace Security\Repo\Group;

use Cartalyst\Sentry\Sentry;
use Security\Repo\BaseRepo;

class SentryGroupRepo extends BaseRepo implements GroupInterface {

	protected $sentry;

	public function __construct(Sentry $sentry)
	{
		$this->sentry = $sentry;
	}

	public function store($data = null)
	{
		$data = $data ?: \Input::all();
		try
		{
		    // Create the group
		    $group = Sentry::createGroup($data);
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
		    Alert::error('Name field is required');
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
		    Alert::error('Group already exists');
		}
		return $data;
	}

	public function update($id, $data = null)
	{
		$data = $data ?: Input::all();
		try
		{
		    // Find the group using the group id
		    $group = Sentry::findGroupById($id);
		    $result = $group->update($data);
		    // Update the group details
		    // $group->name = 'Users';
		    // $group->permissions = array(
		    //     'admin' => 1,
		    //     'users' => 1,
		    // );
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
		    echo 'Group already exists.';
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group was not found.';
		}
		return $result;
	}

	public function destroy($id)
	{
		try
		{
		    // Find the group using the group id
		    $group = $this->sentry->findGroupById($id);

		    // Delete the group
		    $group->delete();
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    return false;
		}
		return true;
	}

	public function byId($id)
	{
		try
		{
		    $group = $this->sentry->findGroupById($id);
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    return false;
		}
		return $group;
	}

	public function byName($name)
	{
		try
		{
		    $group = $this->sentry->findGroupByName($name);
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    return false;
		}
		return $group;
	}

	public function all()
	{
		return $this->sentry->getGroupProvider()->findAll();
	}

}