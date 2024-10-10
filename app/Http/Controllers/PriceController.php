<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Price;
class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Price::with('product')->get();
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'price' => 'required|numeric',
        ]);
    
        return Price::create($validated);
    }
    
    public function show(Price $price)
    {
        return $price->load('product');
    }
    
    public function update(Request $request, Price $price)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'price' => 'required|numeric',
        ]);
    
        $price->update($validated);
        return $price;
    }
    
    public function destroy(Price $price)
    {
        $price->delete();
        return response()->json(null, 204);
    }
    
}
