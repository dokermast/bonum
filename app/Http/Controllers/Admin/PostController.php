<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $post = new Post();
        $input = $request->except('_token');

        Validator::make($input, [
            'title' => ['required', 'string', 'max:25'],
            'image' => ['required']
        ])->validate();

        $path = $request->file('image')->store('uploads', 'public');

        $post->fill($input);
        $post->user_id = auth()->user()->id;
        $post->filename = $input['image']->getClientOriginalName();
        $post->img = $path;

        if (!$post->save()) {
            unlink('storage/public/' . $path);
            return redirect('/admin/posts')->withErrors('Post wasn\'t created');
        }

        return redirect('/admin/posts')->with('status', 'Post was created');
    }


    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories]);
    }


    public function postOn(Request $request)
    {
        Post::find($request->id)->update(['status' => true]);
    }


    public function postOff(Request $request)
    {
        Post::find($request->id)->update(['status' => false]);
    }


    public function update(Request $request, Post $post)
    {
        $input = $request->except("_token");

        if(isset($input['image'])){
            if($post->img && file_exists('storage/public/'.$post->img)){
                unlink('storage/public/'.$post->img);
            }
            $path = $request->file('image')->store('uploads', 'public');
            $post->filename = $input['image']->getClientOriginalName();
            $post->img = $path;
        }
        $post->fill($input);
        if (!$post->save()) {
            unlink('storage/public/' . $path);
            return redirect('/admin/posts')->withErrors('Post wasn\'t updated');
        }

        return redirect('/admin/posts')->with('status', 'Post was updated');
    }


    public function destroy($id)
    {
        $post = Post::find($id);
        $path = 'storage/public/'.$post->img;

        if($post){

            if($post->img && file_exists($path)){
                unlink($path);
            }

            if($post->delete()) {
                return redirect('/admin/posts')->with('status', 'Post was deleted');
            } else {
                return redirect('/admin/posts')->withErrors('Post wasn\'t deleted');
            }
        }

        return redirect('/admin/posts')->withErrors('There is not Post');
    }
}
