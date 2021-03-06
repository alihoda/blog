<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', 'HomeController@home')->name('home');

Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/posts/tags/{tag}', 'BlogPostTagController@index')->name('post-tags');

Route::resource('posts', 'PostController');
Route::resource('posts.comments', 'PostCommentController')->only(['store']);

Route::resource('users', 'UserController')->only(['show', 'edit', 'update']);
Route::resource('users.comments', 'UserCommentsController')->only(['store']);

Auth::routes();
