<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostSubCategory extends Model
{
    protected $table = 'post_sub_categories';

    protected $fillable = [
        'post_main_category_id',
        'sub_category',
    ];

    public function getLists() {
        $categories = PostSubCategory::orderBy('id','asc')->pluck('sub_category','id');
        return $categories;
    }

    public function PostMainCategory(){
        return $this->belongsTo(PostMainCategory::class);
    }
}
