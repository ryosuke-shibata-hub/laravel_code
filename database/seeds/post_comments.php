<?php

use Illuminate\Database\Seeder;
use App\Models\Posts\PostComment;

class post_comments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <=5; $i++) {

            PostComment::create([
            'id' => $i,
            'user_id' => $i,
            'post_id' => $i,
            'comment' => 'てすとだよ'.$i,
            'event_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            ]);

        }
    }
}
