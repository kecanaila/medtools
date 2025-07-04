<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        // ===================== ADMIN METRICS =====================
        if ($role === 'admin') {
            $totalOrders = Order::count();
            $totalRevenue = Order::where('status', 'delivered')
                ->sum('total_amount');
            $totalCustomers = User::where('role', 'customer')->count();
            $totalCategories = Category::count();
            $totalProducts = Product::count();
            $completedOrders = Order::where('status', 'delivered')->count();

            // Monthly order chart
            $monthlyOrdersRaw = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $monthlyOrders = [
                'labels' => $monthlyOrdersRaw->pluck('month')->map(
                    fn($m) =>
                    date('F', mktime(0, 0, 0, $m, 1))
                ),
                'data' => $monthlyOrdersRaw->pluck('count'),
            ];

            return view('dashboard', compact(
                'role',
                'totalOrders',
                'totalRevenue',
                'totalCustomers',
                'totalCategories',
                'totalProducts',
                'completedOrders',
                'monthlyOrders'
            ));
        }

        // ===================== CUSTOMER METRICS ==================
        if ($role === 'customer') {
            $totalOrders = Order::where('user_id', $user->id)->count();
            $completedOrders = Order::where('user_id', $user->id)
                ->where('status', 'delivered')
                ->count();

            return view('dashboard', compact(
                'role',
                'totalOrders',
                'completedOrders'
            ));
        }

        // ===================== VENDOR METRICS ==================
        if ($role === 'vendor') {
            return redirect()->route('vendor.dashboard');
        }

        abort(403, 'Unauthorized');
    }
}
