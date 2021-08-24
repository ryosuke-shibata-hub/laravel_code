<?php

use Illuminate\Database\Seeder;
use App\Models\Posts\PostSubCategory;

class post_sub_categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // for ($i = 4; $i <= 2; $i++) {
            PostSubCategory::create([
                'id'=> 6,
                'post_main_category_id' => 5,
                'sub_category' => 'てっってって',
                'created_at' =>now(),
                'updated_at' => now(),
                'deleted_at' =>now(),
            ]);
        // }
    }
}
