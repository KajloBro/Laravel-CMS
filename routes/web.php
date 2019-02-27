<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Auth::routes();
Route::auth();
Route::get('/logout', 'Auth\LoginController@logout');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'admin'], function() {
    
    Route::get('admin', function() {
        return view('admin.index');
    });

    Route::resource('admin/users', 'AdminUsersController', ['names' =>[
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy'
        ]]);
    
    Route::resource('admin/posts', 'AdminPostsController', ['names' =>[
        'index' => 'admin.posts.index',
        'create' => 'admin.posts.create',
        'store' => 'admin.posts.store',
        'show' => 'admin.posts.show',
        'edit' => 'admin.posts.edit',
        'update' => 'admin.posts.update',
        'destroy' => 'admin.posts.destroy'
        ]]);
    
    Route::resource('admin/categories', 'AdminCategoriesController', ['names' =>[
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy'
        ]]);

    Route::resource('admin/media', 'AdminMediasController', ['names' =>[
        'index' => 'admin.medias.index',
        'create' => 'admin.medias.create',
        'store' => 'admin.medias.store',
        'show' => 'admin.medias.show',
        'edit' => 'admin.medias.edit',
        'update' => 'admin.medias.update',
        'destroy' => 'admin.medias.destroy'
        ]]);

    Route::resource('admin/comments', 'PostCommentsController', ['names' =>[
        'index' => 'admin.comments.index',
        'create' => 'admin.comments.create',
        'store' => 'admin.comments.store',
        'show' => 'admin.comments.show',
        'edit' => 'admin.comments.edit',
        'update' => 'admin.comments.update',
        'destroy' => 'admin.comments.destroy'
        ]]);

    Route::resource('admin/comments/replies', 'CommentRepliesController', ['names' =>[
        'index' => 'admin.replies.index',
        'create' => 'admin.replies.create',
        'store' => 'admin.replies.store',
        'show' => 'admin.replies.show',
        'edit' => 'admin.replies.edit',
        'update' => 'admin.replies.update',
        'destroy' => 'admin.replies.destroy'
        ]]);
    
});


Route::group(['middleware' => 'auth'], function() {

    Route::post('comment/reply', 'CommentRepliesController@createReply');

});


Route::get('/post/{id}', 'AdminPostsController@post')->name('post');