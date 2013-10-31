<?php

class UserTest extends TestCase {


    public function testLoginForm()
    {
        $crawler = $this->client->request('GET', '/login');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testRegisterForm()
    {
        $crawler = $this->client->request('GET', '/register');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
     * Username is required
     */
    public function testUsernameIsRequired()
    {
        // Create a new User
        $user = new User;
        $user->email = "me@test.com";
        $user->password = "password";

        // The user should not save without a username.
        $this->assertFalse($user->save());

        $errors = $user->errors()->all();

        $this->assertCount(1, $errors);

        // The username error should be present.
        $this->assertEquals($errors[0], "The username field is required.");
    }

    /**
     * Email is required
     */
    public function testEmailIsRequired()
    {
        // Create a new User
        $user = new User;
        $user->username = "Dave Tester";
        $user->password = "password";

        // The user should not save without a username.
        $this->assertFalse($user->save());

        $errors = $user->errors()->all();

        $this->assertCount(1, $errors);

        // The username error should be present.
        $this->assertEquals($errors[0], "The email field is required.");
    }
}