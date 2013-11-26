<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::model('user', 'User');
Route::model('post', 'Post');
Route::model('flag', 'Flag');

Route::get('/', 'HomeController@getIndex');

Route::group(array('before' => 'guest'), function() {

	Route::get('login', array(
		'as' => 'session.create',
		'uses' => 'SessionController@create'
	));
	Route::post('login', array(
		'as' => 'session.store',
		'uses' => 'SessionController@store'
	));

});

Route::group(array('before' => 'auth'), function () {
	Route::get('logout', array(
		'as' => 'session.destroy',
		'uses' => 'SessionController@destroy'
	));
});

Route::group(array('before' => 'guest'), function() {

	Route::get('register', array(
		'as' => 'user.create',
		'uses' => 'UsersController@create'
	));

	Route::post('register', array(
		'as' => 'user.store',
		'uses' => 'UsersController@store'
	));

});

Route::group(array('before' => 'auth'), function () {

	Route::get('admin', 'AdminController@getIndex');

	// Route::resource('posts', 'PostsController');

	Route::get('posts', [
		'before' => 'userAccess:posts.index',
		'as' 	 => 'posts.index',
		'uses' 	 => 'PostsController@index'
	]);
	Route::get('posts/create', [
		'before' => 'userAccess:posts.create',
		'as' 	 => 'posts.create',
		'uses' 	 => 'PostsController@create'
	]);
	Route::post('posts', [
		'before' => 'userAccess:posts.create',
		'as' 	 => 'posts.store',
		'uses' 	 => 'PostsController@store'
	]);
	Route::get('posts/{posts}', [
		'before' => 'userAccess:posts.show',
		'as' 	 => 'posts.show',
		'uses' 	 => 'PostsController@show'
	]);
	Route::get('posts/{posts}/edit', [
		'before' => 'resourceAccess:post,posts.edit',
		'as' 	 => 'posts.edit',
		'uses' 	 => 'PostsController@edit'
	]);
	Route::put('posts/{posts}', [
		'before' => 'userAccess:posts.edit',
		'as' 	 => 'posts.update',
		'uses' 	 => 'PostsController@update'
	]);
	Route::delete('posts/{posts}', [
		'before' => 'userAccess:posts.destroy',
		'as' 	 => 'posts.destroy',
		'uses' 	 => 'PostsController@destroy'
	]);

	Route::get('posts/user/{user}', [
		'before' => 'userAccess:posts.user',
		'as' 	 => 'posts.user',
		'uses' 	 => 'PostsController@userPosts'
	]);

	Route::resource('groups', 'GroupsController');

	// User Specific Pages
	Route::get('users',        array('as' => 'users.index', 'uses' => 'UsersController@index'));
	Route::get('users/{user}', array('as' => 'users.show',  'uses' => 'UsersController@show'));

	// Flags
	Route::post('flags', array(
		// 'before' => 'resourceAccess:flag,flag.create',
		'as' => 'flags.store',
		'uses' => 'FlagsController@store'
	));
	Route::get('flags/{flag}', array(
		// 'before' => 'resourceAccess:flag,flag.view',
		'as' => 'flags.show',
		'uses' => 'FlagsController@show'
	));
	Route::delete('flags/{flag}', array(
		// 'before' => 'resourceAccess:flag,flag.delete',
		'as' => 'flags.destroy',
		'uses' => 'FlagsController@destroy'
	));
});

/**
 * ======= Custom Form Macros =======
 */
Form::macro('wysiwyg', function($name, $value = null, $options = array())
{
	$textarea = Form::textarea($name, $value, $options);
	return $textarea . "<script>CKEDITOR.replace('$name');</script>";
});

/**
 * ======= Custom HTML Macros =======
 */
HTML::macro('rawLink', function($url, $title = null, $attributes = array(), $secure = null)
{
	$url = URL::to($url, array(), $secure);

	if (is_null($title) or $title === false) $title = $url;

	return '<a href="'.$url.'"'.HTML::attributes($attributes).'>'.$title.'</a>';
});

HTML::macro('rawLinkRoute', function($name, $title = null, $parameters = array(), $attributes = array())
{
	return HTML::rawLink(URL::route($name, $parameters), $title, $attributes);
});

/**
 *  ====== helpers ======
 */
function getUsername($user_id = null)
{
	try
	{
		return Sentry::findUserById($user_id)->getLogin();
	}
	catch (UserNotFoundException $e)
	{
		return 'Anonymous';
	}
}