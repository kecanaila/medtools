<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showProducts(Category $category)
    {
        $products = $category->products()->where('is_active', true)->paginate(12);
        $categories = Category::all();
        return view('products.index', compact('products', 'category', 'categories'));
    }
}
