<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function  allBlogs()
    {
        $blogcats = PostCategory::get();
        return view('admin.blog.category.index', compact('blogcats'));
    }

    public function storeBlog(Request $request)
    {
        $request->validate([
            'name_en' => 'required|max:255',
            'name_ar' => 'required|max:255',
        ]);

        PostCategory::create([
            'category_name_en' => $request->name_en,
            'category_name_ar' => $request->name_ar,
        ]);

        $notifiction =  array(
            'message' => 'Blog Category Created',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.blogCats')->with($notifiction);
    }


    public function deleteBlog($id)
    {
        PostCategory::findOrFail($id)->delete();
        $notifiction =  array(
            'message' => 'Blog Category deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notifiction);
    }


    public function editBlog(Request $request, $id)
    {
        $blog =   PostCategory::findOrFail($id);
        return view('admin.blog.category.edit', compact('blog'));
    }


    public function updateBlog(Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|max:255',
            'name_ar' => 'required|max:255',
        ]);
        $blog =   PostCategory::findOrFail($id);
        $blog->update([
            'category_name_en' => $request->name_en,
            'category_name_ar' => $request->name_ar,
        ]);

        $notifiction =  array(
            'message' => 'Blog Category Updated',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.blogCats')->with($notifiction);
    }

    public function allPosts()
    {
        $posts = Post::latest()->get();
        return view('admin.blog.post.index', compact('posts'));
    }


    public function addPost()
    {
        $blogcats = PostCategory::get();
        return view('admin.blog.post.create', compact('blogcats'));
    }

    public function storepost(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:post_categories,id',
            'title_en' => 'required|max:255',
            'title_ar' => 'required|max:255',
            'image' => 'nullable|image',
            'details_en' => 'required',
            'details_ar' => 'required',
        ]);

        if ($request->hasFile('image')) {
            // $image_resize = Image::make($request->file('image')->getRealPath())->resize(100, 100);
            // $path = $image_resize->save(public_path('uploads/adminImages/post' . $request->file('image')->getClientOriginalName()));
            $path = Storage::putFile('adminImages/post', $request->file('image'));
        }
        Post::create([
            'category_id' => $request->category_id,
            'title_en'    => $request->title_en,
            'title_ar'    => $request->title_ar,
            'image'       => $path,
            'details_en'  => $request->details_en,
            'details_ar'  => $request->details_ar,
        ]);
        $notifiction =  array(
            'message' => 'Post Created',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.blogPost')->with($notifiction);
    }

    public function deletePost($id)
    {
        Post::findOrFail($id)->delete();
        $notifiction =  array(
            'message' => 'Post deleted',
            'alert-type' => 'success'
        );
        return back()->with($notifiction);
    }


    public function editPost($id)
    {
        $post =  Post::findOrFail($id);
        $blogcats = PostCategory::get();
        return view('admin.blog.post.edit', compact('post', 'blogcats'));
    }

    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:post_categories,id',
            'title_en' => 'required|max:255',
            'title_ar' => 'required|max:255',
            'image' => 'nullable|image',
            'details_en' => 'required',
            'details_ar' => 'required',
        ]);

        $post =  Post::findOrFail($id);
        $path = $post->image;
        if ($request->hasFile('image')) {
            $path = Storage::putFile('adminImages/post', $request->file('image'));
        }

        $post->update([
            'category_id' => $request->category_id,
            'title_en'    => $request->title_en,
            'title_ar'    => $request->title_ar,
            'image'       => $path,
            'details_en'  => $request->details_en,
            'details_ar'  => $request->details_ar,
        ]);
        $notifiction =  array(
            'message' => 'Post updated',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.blogPost')->with($notifiction);
    }
}
