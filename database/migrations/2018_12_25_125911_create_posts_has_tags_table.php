<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsHasTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_has_tags', function (Blueprint $table) {
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('tag_id');

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('tag_id')
                ->references('id')
                ->on('posts_tags')
                ->onDelete('cascade');

            $table->primary(['post_id', 'tag_id']);
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
        Schema::dropIfExists('posts_has_tags');
    }
}
