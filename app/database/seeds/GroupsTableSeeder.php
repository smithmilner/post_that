<?php

class GroupsTableSeeder extends Seeder {

	public function run()
	{

		// Uncomment the below to wipe the table clean before populating
		DB::table('groups')->truncate();

		Sentry::getGroupProvider()->create(array(
			'name'        => 'Administrators',
			'permissions' => array(
				'admin' => 1,
				'users' => 1,
		)));

		Sentry::getGroupProvider()->create(array(
			'name'        => 'Users',
			'permissions' => array(
				'admin' => 0,
				'users' => 1,
		)));

		$adminUser = Sentry::getUserProvider()->findByLogin('Admin');

		$adminGroup = Sentry::getGroupProvider()->findByName('Administrators');
		$userGroup = Sentry::getGroupProvider()->findByName('Users');

		$adminUser->addGroup($adminGroup);
		$adminUser->addGroup($userGroup);

	}

}

