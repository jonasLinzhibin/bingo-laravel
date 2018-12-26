<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//后台路由组
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['auth.admin','auth.menu']], function () {
        Route::get('dashboard', 'Admin\DashboardController@index');
        Route::resource('admins','Admin\AdminsController');
        Route::resource('roles','Admin\RolesController');
        Route::resource('permissions','Admin\PermissionsController');
        Route::resource('users','Admin\UsersController');
        Route::resource('config','Admin\SettingsController');
        Route::resource('message','Admin\MessagesController');

        Route::resource('medias','Admin\MediasController');

        Route::get('menus', 'Admin\MenusController@index')->name('menus.index');
        Route::post('menus/store', 'Admin\MenusController@store')->name('menus.store');
        Route::post('menus/del/{id}', 'Admin\MenusController@del')->name('menus.del');
        Route::post('menus/sort', 'Admin\MenusController@sort')->name('menus.sort');
        Route::get('menus/edit/{id}', 'Admin\MenusController@edit')->name('menus.edit');
        Route::post('menus/update/{id}', 'Admin\MenusController@update')->name('menus.update');
    });

    Route::group(['as' => 'posts.','middleware' => ['auth.admin','auth.menu']], function () {

        Route::post('posts/category/sort', 'Admin\PostsCategoryController@sort')->name('category.sort');
        Route::post('posts/category/del/{id}', 'Admin\PostsCategoryController@del')->name('category.del');
        Route::resource('posts/category','Admin\PostsCategoryController');

        Route::resource('posts/setting','Admin\PostsSettingController');
        Route::resource('posts/tags','Admin\PostsTagsController');
        Route::resource('posts/comments','Admin\PostsCommentsController');
        Route::post('posts/restore/{id}', 'Admin\PostsController@restore')->name('posts.restore');
        Route::get('posts/trash', 'Admin\PostsController@trash')->name('posts.trash');
        Route::post('posts/restore/{id}', 'Admin\PostsController@restore')->name('posts.restore');
        Route::resource('posts','Admin\PostsController');

    });


    Route::group(['as' => 'uploader.','middleware' => ['auth.admin']], function () {
        Route::post('uploader/editor/image', 'Admin\UploadEditorController@image')->name('editor.image');
    });

    Route::group(['middleware' => 'guest.admin'], function () {
        Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    });

    Route::post('login', 'Admin\LoginController@login');
    Route::any('logout', 'Admin\LoginController@logout')->name('admin.logout');
});



