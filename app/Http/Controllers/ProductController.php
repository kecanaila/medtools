<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where('is_active', true);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $products = $query->with('category', 'vendor')->paginate(12);
        $categories = Category::all();

        // Featured products: hanya produk yang is_featured = true
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with('category', 'vendor')
            ->take(8)
            ->get();

        if ($request->route()->getName() === 'home') {
            return view('home', compact('featuredProducts', 'categories'));
        }
        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $reviews = $product->reviews()->with('user')->get();
        return view('products.show', compact('product', 'reviews'));
    }

    // Vendor product management
    public function vendorProducts()
    {
        $user = Auth::user();
        
        if (!$user->isApprovedVendor()) {
            return redirect()->route('home')->with('error', 'You need to be an approved vendor to manage products.');
        }

        $products = $user->products()->with('category')->get();
        return view('vendor.products.index', compact('products'));
    }

    public function create()
    {
        $user = Auth::user();
        
        if (!$user->isApprovedVendor()) {
            return redirect()->route('home')->with('error', 'You need to be an approved vendor to create products.');
        }

        $categories = Category::all();
        return view('vendor.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isApprovedVendor()) {
            return redirect()->route('home')->with('error', 'You need to be an approved vendor to create products.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'linkImage' => 'nullable|string',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'vendor_id' => $user->id,
            'stock' => $request->stock,
            'linkImage' => $request->linkImage,
            'is_active' => true,
        ]);

        return redirect()->route('vendor.products.index')->with('status', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $user = Auth::user();
        
        if (!$user->isApprovedVendor() || $product->vendor_id !== $user->id) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $categories = Category::all();
        return view('vendor.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $user = Auth::user();
        
        if (!$user->isApprovedVendor() || $product->vendor_id !== $user->id) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'linkImage' => 'nullable|string',
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
            'linkImage' => $request->linkImage,
        ]);

        return redirect()->route('vendor.products.index')->with('status', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $user = Auth::user();
        
        if (!$user->isApprovedVendor() || $product->vendor_id !== $user->id) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $product->delete();

        return redirect()->route('vendor.products.index')->with('status', 'Product deleted successfully.');
    }
}
