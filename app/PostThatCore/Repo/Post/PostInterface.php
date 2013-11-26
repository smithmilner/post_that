<?php namespace PostThatCore\Repo\Post;

interface PostInterface {

	public function store($data);

	public function update($id, $data);

	public function destroy($id);

	public function byId($id);

	public function all();

}