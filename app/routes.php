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

});

/**
 * Custom HTML Macros
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
