<?php

use App\Models\Posts\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 5; $i++) {
            post::create([
                'user_id' => $i,
                'post_sub_category_id' => $i,
                'title' =>'laravelvelvel'.$i,
                'post' => 'こっちが内容'.$i,
                'event_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
