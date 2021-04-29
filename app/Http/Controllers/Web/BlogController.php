<?php

namespace App\Http\Controllers\Web;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function blog()
    {
        $posts = Post::get();
        return view('web.blog.blogs', compact('posts'));
    }


    public function blogPost($id)
    {
        $post = Post::findOrFail($id);
        return view('web.blog.single-blog',compact('post'));
    }


















    public function english()
    {
        Session::get('lang');
        Session::forget('lang');
        Session::put('lang', 'english');
        return back();
    }

    public function arabic()
    {
        Session::get('lang');
        Session::forget('lang');
        Session::put('lang', 'arabic');
        return back();
    }
}
