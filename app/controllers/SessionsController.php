<?php

use Security\Repo\Session\SessionInterface;

class SessionController extends BaseController {

	protected $SessionRepo;

	public function __construct(SessionInterface $SessionRepo)
	{
		$this->SessionRepo = $SessionRepo;
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
		$input = Input::except('_token');
		$v = new Security\Services\Validators\Session($input);
		if ($v->passes())
		{
			try
			{
				$this->SessionRepo->store($input);
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
				$username = $input['username'];
				Alert::error("Cannot login user $username as they are not activated.");
				Alert::flash();
				return Redirect::back()->withInput();
			}
		}
		// Success!
		return Redirect::to('/');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		$this->SessionRepo->destroy();
	}

}
