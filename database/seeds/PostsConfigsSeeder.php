<?php

use Illuminate\Database\Seeder;
use App\Models\Post\PostsConfigs;

class PostsConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostsConfigs::create(['need_audit' => 0, 'allow_comment' => 1, 'post_type' => 'blog', 'post_name'=>'博客', 'sort'=>50,
        ]);
        PostsConfigs::create(['need_audit' => 0, 'allow_comment' => 0, 'post_type' => 'news', 'post_name'=>'新闻', 'sort'=>50,
        ]);
        PostsConfigs::create(['need_audit' => 0, 'allow_comment' => 0, 'post_type' => 'article', 'post_name'=>'文章', 'sort'=>50,
        ]);
        PostsConfigs::create(['need_audit' => 0, 'allow_comment' => 0, 'post_type' => 'page', 'post_name'=>'页面', 'sort'=>50,
        ]);
        PostsConfigs::create(['need_audit' => 0, 'allow_comment' => 0, 'post_type' => 'product', 'post_name'=>'产品', 'sort'=>50,
        ]);
        PostsConfigs::create(['need_audit' => 0, 'allow_comment' => 0, 'post_type' => 'helper', 'post_name'=>'帮助文档', 'sort'=>50,
        ]);
    }
}
