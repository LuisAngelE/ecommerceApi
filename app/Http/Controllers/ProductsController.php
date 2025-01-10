<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        $products = products::with('categories', 'images')->get();

        foreach ($products as $product) {
            if ($product->images->isNotEmpty()) {
                $product->image = $product->images->first()->url;
            } else {
                $defaultImage = 'https://yocomparto.com.mx/wp-content/uploads/2024/02/placeholder.png';
                $product->image = $defaultImage;
            }
            $product->unsetRelation('images');
        }

        return response()->json(['data' => $products], 201);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = products::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'message' => 'Product created successfully!',
            'data' => $product,
        ], 201);
    }

    public function show(products $products)
    {
        return response()->json($products);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = products::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'message' => 'Product updated successfully!',
            'data' => $product,
        ], 200);
    }
    
    public function destroy($id)
    {
        $product = products::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully!',
        ], 200);
    }

    public function uploadImage(Request $request, $productId)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = products::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');

            $product->images()->create([
                'url' => $imagePath,
            ]);

            return response()->json(['success' => 'Image uploaded successfully!', 'image_url' => $imagePath], 201);
        }
        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
