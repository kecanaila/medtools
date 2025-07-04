<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

class VendorController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.vendor-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'store_name' => ['required', 'string', 'max:255'],
            'store_description' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'phone' => $request->phone,
            'address' => $request->address,
            'store_name' => $request->store_name,
            'store_description' => $request->store_description,
            'is_approved' => false,
        ]);

        // Send notification to admin about new vendor registration
        $this->notifyAdminAboutNewVendor($user);

        return redirect()->route('login')->with('status', 'Vendor registration submitted successfully. Please wait for admin approval.');
    }

    public function dashboard()
    {
        $user = Auth::user();
        
        if (!$user->isVendor()) {
            return redirect()->route('home');
        }

        $products = $user->products()->with('category')->get();
        $orders = Order::whereHas('items.product', function ($query) use ($user) {
            $query->where('vendor_id', $user->id);
        })->with('user', 'items.product')->get();

        $totalProducts = $products->count();
        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total_amount');
        $pendingOrders = $orders->where('status', 'pending')->count();
        $recentOrders = $orders->sortByDesc('created_at')->take(5);
        $lowStockProducts = $products->where('stock', '<=', 5);
        return view('vendor.dashboard', compact('products', 'orders', 'totalProducts', 'totalOrders', 'totalRevenue', 'pendingOrders', 'recentOrders', 'lowStockProducts'));
    }

    public function profile()
    {
        $user = Auth::user();
        
        if (!$user->isVendor()) {
            return redirect()->route('home');
        }

        return view('vendor.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isVendor()) {
            return redirect()->route('home');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'store_name' => ['required', 'string', 'max:255'],
            'store_description' => ['required', 'string'],
        ]);

        $user->update($request->only(['name', 'phone', 'address', 'store_name', 'store_description']));

        return redirect()->route('vendor.profile')->with('status', 'Profile updated successfully.');
    }

    private function notifyAdminAboutNewVendor($vendor)
    {
        $admins = User::where('role', 'admin')->get();
        
        foreach ($admins as $admin) {
            // You can implement email notification here
            // Mail::to($admin->email)->send(new NewVendorNotification($vendor));
        }
    }
} 