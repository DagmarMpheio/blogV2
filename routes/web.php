<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'BlogController@index')->name('blog');
/*Route::get('/blog/show', function () {
    return view('blog.show');
});*/

Route::get('/blog/{post}', 'BlogController@show')->name('blog.show');
Route::get('/category/{category}', 'BlogController@category')->name('category');

Route::post('/post/{post}/comments', [
    'uses' => 'CommentsController@store',
    'as' => 'blog.comments'
]);

Route::get('/author/{author}', 'BlogController@author')->name('author');
Route::get('/tag/{tag}', 'BlogController@tag')->name('tag');

Auth::routes();
/* rotas admin*/
Route::get('/home', 'Backend\HomeController@index')->name('home');
Route::get('/edit-account', 'Backend\HomeController@edit');
Route::put('/update-account', 'Backend\HomeController@update');
Route::get('/change-password', 'Backend\HomeController@changePassword');
Route::put('/update-password', 'Backend\HomeController@updatePassword');

Route::put('/backend/blog/restore/{blog}', 'Backend\BlogController@restore')->name('backend.blog.restore');

Route::delete('/backend/blog/force-destroy/{blog}', 'Backend\BlogController@forceDestroy')->name('backend.blog.force-destroy');

/*grupo de rotas -> blog*/
Route::group(['prefix' => 'backend', 'namespace' => 'Backend', 'as' => 'backend.'], function () {
    Route::resource('blog', 'BlogController');
});

//grupo de rotas -> categoria
Route::group(['prefix' => 'backend', 'namespace' => 'Backend', 'as' => 'backend.'], function () {
    Route::resource('categories', 'CategoriesController');
});

//grupo de rotas -> users
Route::group(['prefix' => 'backend', 'namespace' => 'Backend', 'as' => 'backend.'], function () {
    Route::resource('users', 'UsersController');
});

//rota para o metodo confirm
Route::get('/backend/users/confirm/{users}', [
    'uses' => 'Backend\UsersController@confirm',
    'as' => 'backend.users.confirm'
]);



