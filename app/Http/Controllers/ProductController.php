<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    // public function getdata()
    // {
    //     $products = DB::table('products')->get();
    //     return response()->json($products);
    // }
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'SKU' => 'required|string|unique:products',
            'quantity' => 'required|integer|min:0',
            'sale_price' => 'required|numeric|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'text' => 'required|string',
        ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);

        // if ($validatedData->fails()) {
        //     return response()->json(['errors' => $validatedData->errors()], 400);
        // }

        // Attach categories to the product
        $categories = $request->input('categories');
        $product->categories()->attach($categories);
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'SKU' => 'required|string|unique:products',
            'quantity' => 'required|integer|min:0',
            'sale_price' => 'required|numeric|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'text' => 'required|string',
        ]);

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->update($validatedData);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
