<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->default(false);
            $table->integer('author_id')->default(false);
            $table->string('title')->default('');
            $table->text('content');
            $table->integer('thumb')->default(false);
            $table->integer('views')->default(0);
            $table->tinyInteger('sort')->default(50);
            $table->tinyInteger('is_top')->default(false);
            $table->tinyInteger('recommended')->default(false);
            $table->tinyInteger('audit')->default(true)
                ->comment('审核 0：待审 1：通过 2：不通过');
            $table->tinyInteger('status')->default(true)
                ->comment('状态 1：正常 0：禁用');
            $table->string('tags')->default('');
            $table->string('seo_title')->default('');
            $table->string('seo_keywords')->default('');
            $table->string('seo_description')->default('');
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
