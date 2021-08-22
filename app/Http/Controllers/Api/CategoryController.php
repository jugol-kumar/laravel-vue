<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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
            'photo' => 'required',
        ]);
        $photo = $request->photo;
        $position = strpos($photo, ';');
        $subString = substr($photo, 0,$position);
        $imageExt = explode( '/',$subString )[1];
        $imageName = time().rand(0000,9999).'.'.$imageExt;
        $resize = Image::make($photo)->resize(200, 180)->encode('jpg');
        Storage::put("public/category/$imageName", $resize->__toString());

        $uploadPath = "storage/category/$imageName";

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $uploadPath;
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
