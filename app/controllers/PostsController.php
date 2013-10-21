<?php

class PostsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::orderBy('updated_at', 'DESC')->get();
        return View::make('posts.index')->with('posts', $posts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$rules = array('title' => 'required');

		$v = Validator::make($input, $rules);

		if ($v->passes()) {

			$post = new Post;
			$post->title = Input::get('title');
			$post->body  = Input::get('body');

			if (Auth::check()) {
				$post->author =	Auth::user()->id;
			}

			$post->save();

			return Redirect::route('posts.index');
		}

		return Redirect::back()->withInput->withErrors($v);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::find($id);

		if (is_null($post)) {

			return Redirect::route('posts.index');

        }

		$author = User::find($post->author);

        return View::make('posts.show')->with('post', $post)->with('author', $author);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $post = Post::find($id);

        if (is_null($post)) {
        	return Redirect::route('posts.index');
        }

        return View::make('posts.edit')->with('post', $post);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$rules = array('title' => 'required');

		$v = Validator::make($input, $rules);

		if ($v->passes()) {

			Post::find($id)->update($input);
			return Redirect::route('posts.index');

		}

		return Redirect::back()->withInput()->withErrors($v);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Post::find($id)->delete();

		return Redirect::route('posts.index');
	}

	/**
	 * Fetch all posts by a certain user.
	 * @param   User $user A user object.
	 * @return  Response
	 */
	public function getUserPosts(User $user) {
		$posts = Post::userPosts($user->id)->get();
		return View::make('posts.user')->with('posts', $posts)->with('author', $user);
	}
}
