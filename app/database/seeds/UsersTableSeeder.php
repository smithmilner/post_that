<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$now = date('Y-m-d H:i:s');

		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$user = [
			[
				'username' => 'Admin',
				'email' => 'info@affinitybridge.com',
				'password' => Hash::make('password'),
				'activated' => 1,
				'created_at' => $now,
                'updated_at' => $now,
			]
			
		];

		// Uncomment the below to run the seeder
		DB::table('users')->insert($user);
	}

}
