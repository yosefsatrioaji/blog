<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    public function create()
    {
        return view('pages.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255|unique:categories'
        ]);
        $slug = SlugService::createSlug(Category::class, 'slug', $request->input('nama'));
        try {
            $postRequest = [
                'nama' => $request->input('nama'),
                'slug' => $slug
            ];
            DB::beginTransaction();
            $post = Category::create($postRequest);
            DB::commit();
            return redirect('/post/list')->with('success', 'Category created successfully.');
        } catch (ModelNotFoundException $e) {
            //
        }
    }

    public function list()
    {
        $categories = Category::withTrashed()->orderBy('nama', 'asc')->get();
        return view('pages.category.list', compact('categories'));
    }

    public function edit()
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        //
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect('/category/list')->with('success', 'Category deleted successfully.');
    }

    public function restore($category)
    {
        $restore = Category::withTrashed()->find($category)->restore();
        return redirect('/category/list')->with('success', 'Category restored successfully.');
    }
}
