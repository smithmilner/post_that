<?php namespace PostThatCore\Repo\Post;

use Authz\Repo\BaseRepo;

class PostRepo extends BaseRepo implements PostInterface {

	protected $session;
	protected $userRepo;

	public function __construct($session, $userRepo)
	{
		$this->session  = $session;
		$this->userRepo = $userRepo;
	}

	public function store($data = null)
	{
		$data = $data ?: \Input::all();

		$post = new \Post($data);
		$user = $this->session->user();

		if ($user->posts()->save($post))
		{
			return $post;
		}

		return false;
	}

	public function update($id, $data)
	{

	}

	public function destroy($id)
	{

	}

	public function byId($id)
	{

	}

	public function all()
	{
		return Post::all();
	}

}