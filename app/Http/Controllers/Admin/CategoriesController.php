<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    //
    private $category;
    private $post;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $all_categories = $this->category->latest()->paginate(10);

        return view('users.admin.category.index')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        $this->category->name  = $request->name;
        $this->category->slug  = $request->slug;
        $this->category->save();

        return redirect()->back();
    }

    public function edit($id)
    {
        $category = $this->category->findOrFail($id);
        return view('users.admin.category.edit')->with('category', $category);


    }

    public function update(Request $request, $id)
    {
        $category = $this->category->findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug;

        $category->save();

        return redirect()->route('admin.categories');
    }

    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories');
    }

}
