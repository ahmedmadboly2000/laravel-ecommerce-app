<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Product;
use Illuminate\Http\Response;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all products
    $products = Product::all();

    // Return as a JSON response with a 200 status code
    return response()->json($products, Response::HTTP_OK);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
    
        return Product::create($validated);
    }
    
    public function show(Product $product)
    {
        return $product;
    }
    
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
    
        $product->update($validated);
        return $product;
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
    
    public function currentPrice(Product $product)
{
    return $product->prices()
        ->whereDate('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
        })
        ->orderBy('start_date', 'desc')
        ->first();
}

}
