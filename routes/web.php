<?php

use App\Category;
use App\Comment;
use App\Post;
use App\Tag;
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
   
    // $tags = Tag::select('id', 'name')->orderByDesc(
    //     DB::table('post_tag')
    //     ->selectRaw('count(tag_id) as tag_count')
    //     ->whereColumn('tags.id', 'post_tag.tag_id')
    //     ->orderBy('tag_count', 'desc')
    //     ->limit(1)
    // )->get();

    // $tags = DB::table('tags')
    //         ->selectRaw('name, COUNT(post_tag.tag_id) as tag_count')
    //         ->leftJoin('post_tag', 'tags.id', '=', 'post_tag.tag_id')
    //         ->groupBy('tags.id')
    //         ->orderByDesc('tag_count')
    //         ->get();
            

    // dd($tags->toArray());

    // $posts = Post::select('id', 'title')->latest()->take(5)->withCount('comments')->get();
    // dd($posts->toArray());
    
 //! with out relationship

    // $posts = DB::table('posts')
    // ->selectRaw('posts.*, COUNT(comments.post_id) as count_comments')
    // ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
    // ->groupBy('posts.id')
    // ->orderByDesc('count_comments')
    // ->get();
    //! If has relationship than use this type of query
    // $posts = Category::select('id', 'title')
    //         ->withCount('comments')
    //         ->orderByDesc('comments_count')
    //         ->get();

    $posts = Category::with(['comments' => function($query) {
        $query->select('title');
    }])->get();

    dd($posts->toArray());





    return view('welcome');
});
