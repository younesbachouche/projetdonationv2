<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Donation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('donations')->get();
        return response()->json($categories);
    }

    public function show($id)
    {
        // API: récupérer par ID
        if (is_numeric($id)) {
            $category = Category::with('donations')->findOrFail($id);
            return response()->json($category);
        }
        
        // Web: récupérer par slug
        $category = Category::where('slug', $id)->firstOrFail();
        $donations = Donation::where('category_id', $category->id)->latest()->paginate(12);
        $categories = Category::all();

        return view('category.show', compact('category', 'donations', 'categories'));
    }
}
