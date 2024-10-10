<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use app\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // Fetch all categories
    $categories = Category::all();

    // Return the categories wrapped in a JSON response
    return response()->json($categories, Response::HTTP_OK);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        return Category::create($validated);
    }
    
    public function show(Category $category)
    {
        return $category;
    }
    
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $category->update($validated);
        return $category;
    }
    
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
    
}
