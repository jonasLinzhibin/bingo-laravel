<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('title', 50);
            $table->string('icon', 50)->nullable();
            $table->string('uri', 50)->nullable();
            $table->string('permission')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('role_has_menus', function (Blueprint $table){
            $table->unsignedInteger('menus_id');
            $table->unsignedInteger('role_id');

            $table->foreign('menus_id')
                ->references('id')
                ->on('menus')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->primary(['menus_id', 'role_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_has_menus');
        Schema::dropIfExists('menus');
    }
}
