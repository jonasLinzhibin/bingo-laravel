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
            $table->string('title')->default('');
            $table->text('content');
            $table->tinyInteger('type')->default(false);
            $table->integer('author_id')->default(false);
            $table->string('tags')->default('');
            $table->string('seo_title')->default('');
            $table->string('seo_keywords')->default('');
            $table->string('seo_description')->default('');
            $table->tinyInteger('sort')->default(50);
            $table->boolean('audit')->default(true)
                ->comment('审核 0：待审 1：通过 2：不通过');
            $table->boolean('status')->default(true)
                ->comment('状态 1：正常 0：禁用');
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
