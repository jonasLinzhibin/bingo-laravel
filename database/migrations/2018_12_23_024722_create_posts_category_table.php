<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(false);
            $table->integer('taxonomy')->default(false);
            $table->string('name')->comment('分类名称');
            $table->string('slug')->comment('分类别名');
            $table->string('seo_title')->default('');
            $table->string('seo_keywords')->default('');
            $table->string('seo_description')->default('');
            $table->tinyInteger('sort')->default(50);
            $table->boolean('status')->default(true)
                ->comment('状态 1：正常 0：禁用');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_category');
    }
}
