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
    //         ->selectRaw('tags.*, COUNT(post_tag.tag_id) as tag_count')
    //         ->leftJoin('post_tag', 'tags.id', '=', 'post_tag.tag_id')
    //         ->groupBy('tags.id')
    //         ->orderByDesc('tag_count')
    //         ->get();
            

    // dd($tags->toArray());

    $posts = Post::select('id', 'title')->latest()->take(5)->withCount('comments')->get();
    dd($posts->toArray());

    return view('welcome');
});
