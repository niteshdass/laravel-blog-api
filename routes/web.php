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
    //! Get all tags with order by most used tag
    // $tags = Tag::select('id', 'name')->orderByDesc(
    //     DB::table('post_tag')
    //     ->selectRaw('count(tag_id) as tag_count')
    //     ->whereColumn('tags.id', 'post_tag.tag_id')
    //     ->orderBy('tag_count', 'desc')
    //     ->limit(1)
    // )->get();

    //! Get latest 5 posts and their number of comments
    // $posts = Post::select('id', 'title', 'content', 'created_at')->withCount('comments')->latest()->take(5)->get();

    //! FInd most popular post and its comments
    //# Way 1
    $post = Post::select('id', 'title', 'content', 'created_at')
    ->withCount('comments')
    ->orderByDesc('comments_count')
    ->get();

    //# Way 2

    $post = Post::select('id', 'title', 'content', 'created_at')
    ->orderByDesc(
        Comment::selectRaw('count(comments.id) as comments_count')
        ->whereColumn('posts.id', 'comments.post_id')
        ->orderBy('comments_count', 'desc')
        ->limit(1)
    )
    ->withCount('comments')
    ->get();


    dump($post->toArray());
    return view('welcome');
});
