<?php

class PostTest extends TestCase {

	// Create
	/**
	 * Test creating posts requires a user.
	 */
	function testUserIsRequired()
	{
		// Create a new post
		$post = new post;

		// Set fields except user
		$post->title = "Test Post";
		$post->body = "Lorem ipsum dolor sit amet";

		// Post should not save
		$this->assertFalse($post->save());

		// Fetch errors
		$errors = $post->errors()->all();

		// There should be 1 error

		// The error for required user should be set.
		$this->assertEquals("The user id field is required.", $errors[0]	);
	}

	/**
	 * Test creating posts requires a title.
	 */
	function testTitleIsRequired()
	{
		// Create a new post
		$post = new post;

		// Set fields except user
		$post->body = "Lorem ipsum dolor sit amet";

		// Create a User
		$user = FactoryMuff::create('user');

		// Post should not save
		$this->assertFalse($user->posts()->save($post));

		// Fetch errors
		$errors = $post->errors()->all();

		// There should be 1 error

		// The error for required user should be set.
		$this->assertEquals("The title field is required.", $errors[0]);
	}

	/**
	 * Test the post gets saved properly.
	 */
	function testPostSavesCorrectly()
	{
		// Create a new post
		$post = FactoryMuff::create('post');

		// Save the post
		$this->assertTrue($post->save());
	}

	// Read
	// Update
	function testPostUpdatesCorrectly()
	{
		// Create a new post
		$post = FactoryMuff::create('post');

		// Set the title to something expected
		$post->title = "Test Title";

		// Update the Post
		$this->assertTrue($post->update());

		// Assert the title changed.
		$this->assertEquals("Test Title", Post::find($post->id)->title);
	}

	// Delete
	function testPostDeletesCorrectly()
	{
		// Create a new post
		$post = FactoryMuff::create('post');

		// Delete the post
		$this->assertTrue($post->delete());
	}

}
