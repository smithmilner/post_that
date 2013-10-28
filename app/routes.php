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

    Route::get('login', 'HomeController@getLogin');
    Route::post('login', 'HomeController@postLogin');

    Route::get('register', 'HomeController@getRegister');
    Route::post('register', 'HomeController@postRegister');

});

Route::group(array('before' => 'auth'), function () {

    Route::get('logout', 'HomeController@logout');
    Route::get('admin', 'AdminController@getIndex');

    Route::resource('posts', 'PostsController');
    // Route::get('posts',              array('as' => 'posts.index',   'uses' => 'PostsController@index'));
    // Route::get('posts/create',       array('as' => 'posts.create',  'uses' => 'PostsController@create'));
    // Route::post('posts',             array('as' => 'posts.store',   'uses' => 'PostsController@store'));
    // Route::get('posts/{posts}',      array('as' => 'posts.show',    'uses' => 'PostsController@show'));
    // Route::get('posts/{posts}/edit', array('as' => 'posts.edit',    'uses' => 'PostsController@edit'));
    // Route::put('posts/{posts}',      array('as' => 'posts.update',  'uses' => 'PostsController@update'));
    // Route::delete('posts/{posts}',   array('as' => 'posts.destroy', 'uses' => 'PostsController@destroy'));

    Route::get('posts/user/{user}', array('as' => 'posts.user', 'uses' => 'PostsController@userPosts'));

    // User Specific Pages
    Route::get('users',        array('as' => 'users.index', 'uses' => 'UsersController@index'));
    Route::get('users/{user}', array('as' => 'users.show',  'uses' => 'UsersController@show'));

    // Flags
    Route::post('flags',          array('as' => 'flags.store',   'uses' => 'FlagsController@store'));
    Route::get('flags/{flag}',    array('as' => 'flags.show',    'uses' => 'FlagsController@show'));
    Route::delete('flags/{flag}', array('as' => 'flags.destroy', 'uses' => 'FlagsController@destroy'));
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
