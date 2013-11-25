<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$user = [
			[
				'username' => 'Admin',
				'email' => 'info@affinitybridge.com',
				'password' => Hash::make('password'),
				'activated' => 1
			]
			
		];

		// Uncomment the below to run the seeder
		DB::table('users')->insert($user);
	}

}
