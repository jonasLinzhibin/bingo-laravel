<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('用户名');
            $table->string('email',191)->unique()->comment('邮箱');
            $table->string('password',191)->comment('密码');
            $table->string('nickname',20)->default('')->comment('用户昵称');
            $table->string('mobile',10)->default('')->comment('手机号');
            $table->string('avatar',191)->default('')->comment('头像');
            $table->string('description',191)->default('')->comment('个人描述');
            $table->string('register_ip',15)->default('')->comment('注册IP');
            $table->integer('login_num')->default(0)->comment('登录次数');
            $table->string('last_login_ip',15)->default('')->comment('最后登录ip');
            $table->integer('score')->default(0)->comment('用户积分');
            $table->integer('recommend_uid')->default(0)->comment('推荐人会员ID');
            $table->decimal('money',10,2)->default(0)->comment('金额');
            $table->integer('level')->default(0)->comment('等级');
            $table->boolean('is_lock')->default(false)->comment('是否锁定。0否，1是');
            $table->boolean('actived')->default(true)->comment('是否激活，0否，1是');
            $table->boolean('status')->default(true)
                ->comment('用户状态 0：禁用； 1：正常 ');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
