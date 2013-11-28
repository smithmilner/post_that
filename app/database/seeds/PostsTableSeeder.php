<?php

class PostsTableSeeder extends Seeder {

	public function run()
	{
		$now = date('Y-m-d H:i:s');

		// Uncomment the below to wipe the table clean before populating
		DB::table('posts')->truncate();

		$posts = [
			[
				'title' => 'first post',
				'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus, nulla, illum, consequatur minus numquam dolores rem hic quisquam labore vel fugiat sapiente facere error mollitia ullam ipsa iste doloremque? Nostrum?',
				'status' => 1,
				'created_at' => $now,
                'updated_at' => $now,
                'user_id' => 1,
			],
			[
				'title' => 'second post',
				'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus, nulla, illum, consequatur minus numquam dolores rem hic quisquam labore vel fugiat sapiente facere error mollitia ullam ipsa iste doloremque? Nostrum?',
				'status' => 1,
				'created_at' => $now,
                'updated_at' => $now,
                'user_id' => 1,
			],
			[
				'title' => 'third post',
				'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus, nulla, illum, consequatur minus numquam dolores rem hic quisquam labore vel fugiat sapiente facere error mollitia ullam ipsa iste doloremque? Nostrum?',
				'status' => 1,
				'created_at' => $now,
                'updated_at' => $now,
                'user_id' => 1,
			],
			[
				'title' => 'forth post',
				'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus, nulla, illum, consequatur minus numquam dolores rem hic quisquam labore vel fugiat sapiente facere error mollitia ullam ipsa iste doloremque? Nostrum?',
				'status' => 1,
				'created_at' => $now,
                'updated_at' => $now,
                'user_id' => 1,
			],
			[
				'title' => 'fifth post',
				'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus, nulla, illum, consequatur minus numquam dolores rem hic quisquam labore vel fugiat sapiente facere error mollitia ullam ipsa iste doloremque? Nostrum?',
				'status' => 1,
				'created_at' => $now,
                'updated_at' => $now,
                'user_id' => 1,
			],
		];

		// Uncomment the below to run the seeder
		DB::table('posts')->insert($posts);
	}

}
