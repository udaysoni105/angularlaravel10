<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
class CategoriesController extends Controller
{
    // public function getdata()
    // {
    //     $categories = DB::table('categories')->get();
    //     return response()->json($categories);
    // }
    public function index()
    {
        $categories = Categories::all();
        return response()->json($categories);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        // Create the categories
        $categories = new categories();
        $categories->name = $request->input('name');
        $categories->save();
    
        // Attach categories to the categories
        $categories = $request->input('categories');
        $categories->categories()->attach($categories);
    
        return response()->json(['message' => 'categories created successfully'], 201);
    }

    public function show($id)
    {
        $category = Categories::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Categories::findOrFail($id);
        $category->name = $request->input('name');
        $category->save();

        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
