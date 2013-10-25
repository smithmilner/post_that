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
}