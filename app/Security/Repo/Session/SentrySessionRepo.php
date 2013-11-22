<?php namespace Security\Repo\Session;

use Cartalyst\Sentry\Sentry;
use Security\Repo\BaseRepo;

class SentrySessionRepo extends BaseRepo Implements SessionInterface {

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
			$user = $this->sentry->authenticate($data, false);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    Alert::error('Login field is required.');
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    Alert::error('Password field is required.');
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		   Alert::error('Wrong password, try again.');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    Alert::error('User was not found.');
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    Alert::error('User is not activated.');
		}
		return $user;

	}

	public function destroy()
	{
		$this->sentry->logout();
	}
}