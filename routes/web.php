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

Route::get('post/{id}',['as'=>'home.post','uses'=>'AdminPostsController@post']);

Route::group(['middleware'=>'admin'],function(){

    Route::get('/admin', function(){

        return view('admin.index');


    });

    Route::resource('admin/users', 'AdminUsersController',['names'=>[

        'index'=>'admin.users.index',
        'create'=>'admin.users.create',
        'store'=>'admin.users.store',
        'edit'=>'admin.users.edit',


    ]]);
    Route::resource('admin/posts','AdminPostsController',['names'=>[
        'index'=>'admin.posts.index',
        'create'=>'admin.posts.create',
        'edit'=>'admin.posts.edit',
    ]]);

    Route::resource('admin/categories','AdminCategoryController',['names'=>[
        'index'=>'admin.categories.index',
        'edit'=>'admin.categories.edit'
    ]]);
    Route::resource('/admin/Comments','AdminCommentsController',['names'=>[
        'index'=>'admin.Comments.index',
        'create'=>'admin.Comments.create',
        'show' =>'admin.Comments.show'
    ]]);
    Route::resource('/admin/Comments/CommentReply','CommentRepliesController',['names'=>[
        'index'=>'admin.Comments.CommentReply.index',
        'create'=>'admin.Comments.CommentReply.create',
        'show'=>'admin.Comments.CommentReply.show'
    ]]);

    Route::resource('/admin/u','adminController',['names'=>[
        'index'=>'admin.u.index',
        'create'=>'admin.u.create',
        'store'=>'admin.u.store',
        'edit'=>'admin.u.edit'
    ]]);

    Route::resource('/admin/media','MediaController',['names'=>[
        'index'=>'admin.media.index',
        'create'=>'admin.media.create'
    ]]);


});


route::group(['middleware'=>'auth'],function (){

    route::post('comment/reply','CommentRepliesController@createreply');

});


route::get('/logout','HomeController@logout');

