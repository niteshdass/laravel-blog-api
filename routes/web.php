<?php

use App\Category;
use App\Comment;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
   // Create post 
   $user_id = 1;

   $category_id = 1;

   $post = new Post();
   
   $post->title = 'post_title';

   $post->content = 'post_content';
    // if there has belongs to relationship and you want to insert the value in same time, then you should follow the following rules
   $post->category()->associate($category_id);
    // if there has many to relationship and you want to insert the value in same time, then you should follow the following rules
   $result = User::find($user_id)->posts()->save($post);

   dd($result);

    return view('welcome');
});
