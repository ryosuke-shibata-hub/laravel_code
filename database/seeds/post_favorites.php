<?php

use Illuminate\Database\Seeder;
use App\Models\Posts\PostFavorite;

class post_favorites extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 2; $i++){
            PostFavorite::create([
                'id' => $i,
                'user_id' => $i,
                'post_id' => $i,
                'created_at' =>now(),
                'updated_at' =>now(),

            ]);
    }
}
}
