<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30|min:1|unique:categories',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        Category::create($data);
        return response()->json(['message' => 'Category save successfully done.'], 200);
    }
    public function show(Category $category)
    {
        return response()->json($category);
    }
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:30|min:1|unique:categories',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $category->update($data);
        return response()->json(['message' => 'Category save successfully done.'], 200);
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category save successfully done.'], 200);
    }
}
