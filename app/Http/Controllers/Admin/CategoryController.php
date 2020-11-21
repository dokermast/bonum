<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        $parents = Category::where('parent_id', 0)->get();
        return view('admin.categories.create', ['categories' => $parents]);
    }


    public function store(Request $request)
    {
        $category = new Category();
        $input = $request->except('_token');
        Validator::make($input, [
            'name' => ['required', 'string', 'max:25'],
        ])->validate();

        $category->fill($input);
        $category->slug = Str::slug($input['name'], '-');
        if ($category->save()) {
            return redirect('/admin/categories')->with('status', 'Category was created');
        } else {
            return redirect('admin/categories/create')->withErrors('Category wasn\'t created');
        }
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => Category::find($category->id),
            'categories' => Category::where('parent_id', 0)->get(),
            ]);
    }


    public function update(Request $request, Category $category)
    {
        $input = $request->except('_token');
        Validator::make($input, [
            'name' => ['required', 'string', 'max:25'],
        ])->validate();
        $category = Category::find($category->id);
        $category->fill($input);
        $category->slug = Str::slug($input['name'], '-');
        if ($category->update()) {
            return redirect('/admin/categories')->with('status', 'Category was updated');
        } else {
            return redirect('/admin/categories/edit/'.$category)->withErrors('Category wasn\'t updated');
        }
    }


    public function destroy(Category $category)
    {
        $category = Category::find($category->id);

        if (isset($category->child)){
            if(count($category->child) > 0){
                return redirect('/admin/categories')->withErrors('The Category has child categories, please remove them before');
            }
        }

        if ($category->delete()) {
            return redirect('/admin/categories')->with('status', 'The Category was deleted');
        } else {
            return redirect('/admin/categories')->withErrors('The Category wasn\'t deleted');
        }
    }


    public function categoryStatus(Request $request)
    {
        $category = Category::find($request->id);

        Category::find($request->id)->update(['status' => $request->status]);
        $ids = null;
        if(count($category->child) > 0){
            Category::where('parent_id', $request->id)->update(['status' => $request->status]);
            $ids = Category::where('parent_id', $request->id)->pluck('id')->toArray();
        }

        return response()->json(['ids' => $ids]);
    }
}
