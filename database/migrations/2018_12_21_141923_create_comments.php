<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->integer('blog_id');
            $table->integer('user_id');
            $table->boolean('audit')->default(true)
                ->comment('审核 0：待审 1：通过 2：不通过');
            $table->boolean('status')->default(true)
                ->comment('状态 1：有效 0：无效');

//            $table->foreign('blog_id')
//                ->references('id')
//                ->on('blogs')
//                ->onDelete('cascade');

//            $table->foreign('user_id')
//                ->references('id')
//                ->on('users')
//                ->onDelete('cascade');

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
        Schema::dropIfExists('comments');
    }
}
