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
		$input = Input::only('username', 'password');
		$v = User::validateLogin($input);

		// If creds are valid and login is sucessful.
		if ($v->passes() && User::login($input)) {
			return Redirect::to('admin');
		}

		return Redirect::to('login')->withErrors($v);
	}

	public function getRegister()
	{
		return View::make('home.register');
	}

	public function postRegister()
	{
		$user = new User;
		if ($user->save()) {

			User::login(Input::only('username','password'));
			return Redirect::to('login')->with('message', 'Thanks for Registering.');

		} else {

			return Redirect::to('register')->withInput()->withErrors($user->errors());

		}
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('login');
	}
}