<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::with('category')->with('supplier')->get());
    }
    public function store(Request $request)
    {
//        return $request;
        $file = $request->photo;
        $file->store('productphoto');

//        return $request;
//        exit();

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        Product::create($data);
        return response()->json(['message' =>'Product save successfully done.'], 200);
    }
    public function show(Product $product)
    {
        return response()->json($product);
    }
    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        $product->update($data);
        return response()->json(['message' =>'Product updated successfully done.'], 200);
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' =>'Product delete successfully done.'], 200);
    }
    public function productByCategory($id){
        $products = Product::where('cat_id', $id)->get();
        return response()->json($products);
    }
}
