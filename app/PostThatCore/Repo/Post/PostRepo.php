<?php namespace PostThatCore\Repo\Post;

use Security\Repo\BaseRepo;
use Cartalyst\Sentry\Sentry;

class PostRepo extends BaseRepo implements PostInterface {

	protected $sentry;

	public function __construct(Sentry $sentry)
	{
		$this->sentry = $sentry;
	}

	public function store($data = null)
	{
		$data = $data ?: \Input::all();

		$post = new \Post($data);
		$user = $this->sentry->getUser();
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

	}

}