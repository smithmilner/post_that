<?php

use Authz\Repo\Session\SessionInterface;
use Authz\Repo\Profile\ProfileInterface;
use Authz\Repo\User\UserInterface;

class SessionController extends BaseController {

	protected $session;
	protected $profileRepo;
	protected $userRepo;

	public function __construct(SessionInterface $session, ProfileInterface $profileRepo, UserInterface $userRepo)
	{
		$this->session = $session;
		$this->profileRepo = $profileRepo;
		$this->userRepo = $userRepo;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$linkedinLink = link_to_route('sessions.create.linkedin', 'Login with Linkedin', array(), array('class' => 'btn btn-success'));
        return View::make('sessions.create')->with('linkedInLink', $linkedinLink);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate input
		$v = ValidatorFactory::make('session');

		if ($v->passes())
		{
			// save the session
			if ($this->session->store(Input::except('_token')))
			{
				return Redirect::route('home.index');
			}
		}

		return Redirect::back()->withErrors($v->errors);
	}

	public function getLinkedin()
	{

		// get data from input
		$code = Input::get('code');

		$linkedinService = OAuth::consumer('Linkedin');

		if (!empty($code)) {

			// This was a callback request from linkedin, get the token
			$token = $linkedinService->requestAccessToken($code);
			_p($token);
			// Send a request with it. Please note that XML is the default format.
			$result = json_decode($linkedinService->request('/people/~:(id,first-name,last-name,industry,email-address,phone-numbers,main-address,twitter-accounts)?format=json'), true);

			$profile = $this->profileRepo->findByLinkedIn($result['id']);
			if (!$profile)
			{
				// make a user
				$user = $this->userRepo->create([
					'username' => $result['firstName'] . ' ' . $result['lastName'],
					'email' => $result['emailAddress'],
					'password' => Hash::make('fakepassword')
				]);
				$user->save();
	            // $user->name = $me['first_name'].' '.$me['last_name'];
	            // $user->email = $me['email'];
	            // $user->photo = 'https://graph.facebook.com/'.$me['username'].'/picture?type=large';
				// make a profile
				$profile = $this->profileRepo->create([
					'firstName' => $result['firstName'],
					'lastName' => $result['lastName'],
					'linkedinId' => $result['id']
				]);
				$user->profiles()->save($profile);
			}

			$profile->linkedinToken = $token->getAccessToken();
			$profile->save();
			$user = $profile->user;

			Auth::login($user);

			return Redirect::to('/')->with('message', 'Logged in with LinkedIn');

		}// if not ask for permission first
		else {
			// get linkedinService authorization
			$url = $linkedinService->getAuthorizationUri(['state' => csrf_token()]);

			// return to linkedin login url
			return Response::make()->header( 'Location', (string)$url );
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		$this->session->destroy();
		return Redirect::route('sessions.create');
	}

}
