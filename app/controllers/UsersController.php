<?php

use Security\Repo\User\UserInterface;
use Security\Repo\Session\SessionInterface;

class UsersController extends BaseController {

	protected $UserRepo;
	protected $session;

	public function __construct(UserInterface $UserRepo, SessionInterface $session)
	{
		$this->UserRepo = $UserRepo;
		$this->session = $session;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->UserRepo->all();
		return View::make('users.index')->with('users', $users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::except('_token');
		$v = new Security\Services\Validators\User($input);

		if ($v->passes())
		{
			$this->UserRepo->store($input);
			$this->session->store($input);
			return Redirect::to('admin')->with('message', 'Thanks for Registering.');

		}

		Alert::error($v->errors)->flash();
		return Redirect::back()->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($user)
	{
		$flags = $user->flags;
		return View::make('users.show')->with('user', $user)->with('flags', $flags);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('users.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
