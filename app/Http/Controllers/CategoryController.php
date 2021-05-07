<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function listCategories()
    {
        $categories = Category::all();

        return view('categories\list', ['categories' => $categories]);
    }

    public function editCategory($id)
    {
        $categories = Category::where('id',$id)->first();

        return view('categories\edit', ['categories' => $categories]);
    }

    public function deleteCategory($id)
    {
        Category::where('id',$id)->delete();

        return redirect()->route('categories_list');
    }

    public function saveExistingCategory(Request $request)
    {
        Category::where('id',$request->input('id'))
            ->update([
                'name' => $request->input('name'),
            ]);
        return redirect()->route('categories_list');

    }

    public function createCategory()
    {
        return view('categories\create', ['name' => 'James']);
    }

    public function saveCategory(Request $request)
    {
        Category::create([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('categories_list');
    }


    //
}
