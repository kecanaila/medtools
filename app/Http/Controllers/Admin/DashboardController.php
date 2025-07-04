<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalVendors = User::where('role', 'vendor')->count();
        $pendingVendors = User::where('role', 'vendor')->where('is_approved', false)->count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $pendingVendorsList = User::where('role', 'vendor')->where('is_approved', false)->get();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCategories = Category::count();
        $totalRevenue = Order::where('status', 'paid')->sum('total_amount');
        $totalReviews = \App\Models\Review::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalVendors',
            'pendingVendors',
            'recentOrders',
            'pendingVendorsList',
            'totalProducts',
            'totalOrders',
            'totalCategories',
            'totalRevenue',
            'totalReviews',
        ));
    }
} 