<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listProducts()
    {
        $products = Product::with('category')->get();
        return view('products\list', ['products' => $products]);
    }

    public function editProduct($id)
    {
        $product = Product::where('id',$id)->first();

        return view('products\edit', ['product' => $product]);
    }

    public function deleteProduct($id)
    {
         Product::where('id',$id)->delete();

        return redirect()->route('products_list');
    }

    public function saveExistingProduct(Request $request)
    {
        Product::where('id',$request->input('id'))
        ->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'in_stock' => $request->input('in_stock'),
            'is_active' => $request->input('is_active', false),
            'category_id' => $request->input('category_id'),
        ]);
        return redirect()->route('products_list');

    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('products\create', ['categories' => $categories]);
    }

    public function saveProduct(Request $request)
    {
        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'in_stock' => $request->input('in_stock'),
            'is_active' => $request->input('is_active', false),
            'category_id' => $request->input('category_id'),
        ]);
        return redirect()->route('products_list');
    }




    //
}
