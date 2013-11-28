<?php

use Authz\Repo\Session\SessionInterface;

class SessionController extends BaseController {

	protected $session;

	public function __construct(SessionInterface $session)
	{
		$this->session = $session;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('sessions.create');
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
