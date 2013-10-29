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

		if (!Auth::check()) {
			return new NotFoundHttpException;
		}

		$post = new Post($input);

		if (Auth::user()->posts()->save($post)) {

			return Redirect::route('posts.show', array($post->id));
		}

		// Set errors
		$post->displayErrors();
		return Redirect::back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::findOrFail($id);

		if (is_null($post)) {

			return Redirect::route('posts.index');

        }

        $flags = $post->flags;
        return View::make('posts.show')->with('post', $post)->with('flags', $flags);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $post = Post::findOrFail($id);

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
		$post = Post::findOrFail($id);

		if ($post->update(Input::all())) {

			return Redirect::route('posts.index');

		}
		// Set errors
		$post->displayErrors();
		return Redirect::back()->withInput();
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
	public function userPosts(User $user) {
		$posts = $user->posts;
		return View::make('posts.user')->with('posts', $posts)->with('author', $user);
	}
}
