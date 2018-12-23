<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('need_audit')->default(false);
            $table->integer('allow_comment')->default(false);
            $table->string('post_type')->comment('文档类型');
            $table->string('post_name')->comment('类型名称');
            $table->tinyInteger('sort')->default(50);
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
        Schema::dropIfExists('posts_configs');
    }
}
