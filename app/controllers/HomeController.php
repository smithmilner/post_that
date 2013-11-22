<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		return View::make('home.index');
	}

	public function getLogin()
	{
		if (Auth::check()) {

			return Redirect::to('admin');

		}

		return View::make('home.login');
	}

	public function postLogin()
	{
		$v = new Services\Validators\Login;

		// If creds are valid and login is sucessful.
		if ($v->passes() && User::login()) {
			return Redirect::to('admin');
		}

		Alert::error($v->errors)->flash();
		return Redirect::to('login')->withInput();
	}

	public function getRegister()
	{
		return View::make('home.register');
	}

	public function postRegister()
	{
		$v = new Services\Validators\User;

		if ($v->passes())
		{
			$user = new User(Input::except('_token'));
			$user->login();
			return Redirect::to('admin')->with('message', 'Thanks for Registering.');

		}

		Alert::error($v->errors)->flash();
		return Redirect::back()->withInput();
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('login');
	}
}