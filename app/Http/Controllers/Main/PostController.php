<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function posts(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
            ->where('status', 1)
            ->where('removed', 0)
            ->paginate(5);
        return view('main.category', ['posts' => $posts, 'category' => $category]);
    }


    public function create()
    {
        return view('main.posts.create', ['categories' => category::all()]);
    }


    public function store(Request $request)
    {
        $post = new Post();
        $input = $request->except('_token');

        Validator::make($input, [
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:3000'],
            'image' => ['required']
        ])->validate();

        $path = $request->file('image')->store('uploads', 'public');

        $post->fill($input);
        $post->user_id = auth()->user()->id;
        $post->filename = $input['image']->getClientOriginalName();
        $post->img = $path;

        if (!$post->save()) {
            unlink('storage/' . $path);
            return redirect('/posts')->withErrors('Post wasn\'t created');
        }
        return redirect('/')->with('status', 'Post was created');
    }


    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);

        if ($post->user_id == auth()->user()->id){
            if($post){
                $post->removed = true;
                $post->save();

                return redirect()->back()->with('status', 'The post was removed');
            }
            return redirect()->back()->withErrors('There isn\'t post');
        }
        return redirect()->back()->withErrors('You can\'t remove this post');
    }
}
