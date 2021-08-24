<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            // PostsTableSeeder::class,
            UsersTableSeeder::class,
            // post_sub_categories::class,
            // post_main_categories::class,
            // post_favorites::class,
            // post_comments::class,
        ]);
    }
}
