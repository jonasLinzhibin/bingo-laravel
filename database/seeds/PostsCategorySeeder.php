<?php

use Illuminate\Database\Seeder;
use App\Models\Post\PostsCategory;

class PostsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostsCategory::create(['parent_id' => 0, 'taxonomy' => 1, 'name' => '博客分类', 'slug'=>'blog']);
        PostsCategory::create(['parent_id' => 0, 'taxonomy' => 5, 'name' => '产品文章分类', 'slug'=>'product']);
        PostsCategory::create(['parent_id' => 0, 'taxonomy' => 2, 'name' => '新闻分类', 'slug'=>'news']);
    }
}
