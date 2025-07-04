<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->with('orders')->get();
        return view('admin.users.index', compact('users'));
    }

    public function vendors()
    {
        $vendors = User::where('role', 'vendor')->with('products')->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function approveVendor($id)
    {
        $vendor = User::findOrFail($id);
        
        if ($vendor->role !== 'vendor') {
            return redirect()->back()->with('error', 'User is not a vendor.');
        }

        $vendor->update([
            'is_approved' => true,
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        // Send approval notification to vendor
        // Mail::to($vendor->email)->send(new VendorApprovedNotification($vendor));

        return redirect()->back()->with('status', 'Vendor approved successfully.');
    }

    public function rejectVendor($id)
    {
        $vendor = User::findOrFail($id);
        
        if ($vendor->role !== 'vendor') {
            return redirect()->back()->with('error', 'User is not a vendor.');
        }

        $vendor->update([
            'is_approved' => false,
            'approved_at' => null,
            'approved_by' => null,
        ]);

        // Send rejection notification to vendor
        // Mail::to($vendor->email)->send(new VendorRejectedNotification($vendor));

        return redirect()->back()->with('status', 'Vendor rejected successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Cannot delete admin user.');
        }

        $user->delete();

        return redirect()->back()->with('status', 'User deleted successfully.');
    }
}
