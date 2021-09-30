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

        for ($i = 1; $i <= 5; $i++) {
            PostSubCategory::create([
                'id'=> $i,
                'post_main_category_id' => $i,
                'sub_category' => 'てっってって'.$i,
                'created_at' =>now(),
                'updated_at' => now(),
                'deleted_at' =>now(),
            ]);
        }
    }
}
