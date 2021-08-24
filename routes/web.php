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

// Route::get('/', function () {
//     return view('welcome');
// });

route::get('/login','Auth\Login\LoginController@login')->name('login');
route::post('/login','Auth\Login\LoginController@login');


route::get('/register','Auth\Register\RegisterController@register');
route::post('/register','Auth\Register\RegisterController@register');

route::get('/added','Auth\Register\RegisterController@added');


Route::group(['middleware' =>['auth']], function(){

route::get('/top','User\Post\PostsController@top')->name('top');
route::post('/top','User\Post\PostsController@top');

route::get('/posts','Admin\Post\PostSubCategoriesController@create');
route::post('/posts','Admin\Post\PostSubCategoriesController@posts_create');

route::get('/my_post','User\Post\PostsController@my_post');

Route::get('/logout', 'Auth\Login\LoginController@logout');

Route::get('/post/{id}','User\Post\PostCommentsController@comment');
Route::post('/post/{id}','User\Post\PostCommentsController@create_comment');

route::get('/edit/{id}','User\Post\PostCommentsController@edit');
route::get('/update/{id}','User\Post\PostCommentsController@update')->name('update');
route::get('/delete/{id}','User\Post\PostCommentsController@delete');
route::get('/comment_edit/{id}','User\Post\PostCommentsController@comment_edit')->name('comment_edit');
route::get('/comment_update/{id}','User\Post\PostCommentsController@comment_update')->name('comment_update');
route::get('/comment_delete/{id}','User\Post\PostCommentsController@comment_delete');

Route::middleware(['auth','can:isAdmin'])->group(function(){
route::get('create_category','Admin\Post\PostMainCategoriesController@create_category');
route::post('create_category','Admin\Post\PostMainCategoriesController@create_main_category');

});


});
