<?php

namespace App\Http\Controllers\Main;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();

        $posts = Post::whereHas('category', function ($query){
            $query->where('status', 1);
        })
            ->where('status', 1)
            ->where('removed', 0)
            ->paginate(5);

        return view('main.main', ['posts' => $posts, 'categories' => $categories]);
    }


    public function categories()
    {
        $categories = Category::where('status', 1)->get();

        return view('main.categories', ['categories' => $categories]);
    }

}
