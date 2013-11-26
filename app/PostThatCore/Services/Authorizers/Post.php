<?php namespace PostThatCore\Services\Authorizers;

class Post extends Authorizer {

	protected function EditHook()
	{
		if ($this->resource->user_id == $this->user->id)
		{
			return true;
		}

		$this->user->hasAccess($this->perm);
	}
}
