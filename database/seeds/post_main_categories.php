<?php

use Illuminate\Database\Seeder;
use App\Models\Posts\PostMainCategory;

class post_main_categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 2; $i++) {
            PostMainCategory::create([
                'id'=> $i,
                'main_category' => 'メイン'.$i,
                'created_at' =>now(),
                'updated_at' => now(),
                'deleted_at' =>now(),
            ]);
        }
    }
}
