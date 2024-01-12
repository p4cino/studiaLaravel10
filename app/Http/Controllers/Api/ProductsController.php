<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Http\Resources\Product as ProductResource;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Laravel Purity for auto filters
        return ProductResource::collection(Product::filter()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'price' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'image' => 'required|image',
        ]);

        $formattedPrice = number_format($request->input('price'), 2, '.', '');

        $path = $request->file('image')->store('images', 'public');
        $requestData = $request->all();
        $requestData['price'] = $formattedPrice;
        $requestData['image'] = $path;

        $product = Product::create($requestData);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'body' => 'sometimes|string',
            'price' => 'sometimes|decimal:2',
            'amount' => 'sometimes|numeric|min:0',
            'image' => 'sometimes|image',
        ]);

        $requestData = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $requestData['image'] = $path;
        }

        $product->update($requestData);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
