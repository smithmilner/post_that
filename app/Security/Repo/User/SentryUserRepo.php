<?php namespace Security\Repo\User;

use Cartalyst\Sentry\Sentry;
use Security\Repo\BaseRepo;

class SentryUserRepo extends BaseRepo implements UserInterface {

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
		    // Create the user
		    $data['activated'] = true;
		    $user = $this->sentry->createUser($data);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    Alert::error('Login field is required.');
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    Alert::error('Password field is required.');
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    Alert::error('User with this login already exists.');
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    Alert::error('Group was not found.');
		}
		return $user;
	}

	public function update($id, $data = null)
	{
		$data = $data ?: \Input::all();

		try
		{
		    $user = $this->sentry->findUserById($id);
		    $result = $user->update($data);
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    Alert::error('User was not found.');
		}
		return $result;
	}

	public function destroy($id)
	{
		try
		{
		    // Find the user using the user id
		    $user = $this->sentry->findUserById($id);

		    // Delete the user
		    $user->delete();
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    Alert::error('User was not found.');
		    return false;
		}
		return true;
	}

	public function byId($id)
	{
		try
		{
			$user = $this->sentry->findUserById($id);
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			Alert::error('User was not found.');
			return false;
		}
		return $user;
	}

	public function all()
	{
		return $this->sentry->findAllUsers();
	}

}
