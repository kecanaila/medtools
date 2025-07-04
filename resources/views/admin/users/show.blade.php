@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">User Details</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Detailed information about {{ $user->name }}
                    </p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.users.index') }}" 
                       class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                        Back to Users
                    </a>
                    @if($user->role !== 'admin')
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700"
                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                Delete User
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- User Information -->
            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">User Information</h2>
                    </div>
                    
                    <div class="px-6 py-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->name }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1
                                    @if($user->role === 'customer') bg-blue-100 text-blue-800
                                    @elseif($user->role === 'vendor') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                @if($user->role === 'vendor')
                                    @if($user->is_approved)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1 bg-green-100 text-green-800">
                                            Approved
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1 bg-yellow-100 text-yellow-800">
                                            Pending Approval
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1 bg-gray-100 text-gray-800">
                                        Active
                                    </span>
                                @endif
                            </div>
                            
                            @if($user->phone)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $user->phone }}</p>
                                </div>
                            @endif
                            
                            @if($user->address)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Address</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $user->address }}</p>
                                </div>
                            @endif
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Member Since</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('F j, Y g:i A') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('F j, Y g:i A') }}</p>
                            </div>
                        </div>
                        
                        @if($user->role === 'vendor')
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Store Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Store Name</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $user->store_name }}</p>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Store Description</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $user->store_description }}</p>
                                    </div>
                                    
                                    @if($user->is_approved)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Approved At</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $user->approved_at->format('F j, Y g:i A') }}</p>
                                        </div>
                                        
                                        @if($user->approvedBy)
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Approved By</label>
                                                <p class="mt-1 text-sm text-gray-900">{{ $user->approvedBy->name }}</p>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                
                                @if(!$user->is_approved)
                                    <div class="mt-6 flex space-x-3">
                                        <form action="{{ route('admin.vendors.approve', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                                Approve Vendor
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.vendors.reject', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                                Reject Vendor
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="space-y-6">
                <!-- User Statistics -->
                <div class="bg-white border border-gray-200 rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Statistics</h2>
                    </div>
                    
                    <div class="px-6 py-4">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Total Orders</span>
                                <span class="text-sm text-gray-900">{{ $user->orders->count() }}</span>
                            </div>
                            
                            @if($user->role === 'vendor')
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Total Products</span>
                                    <span class="text-sm text-gray-900">{{ $user->products->count() }}</span>
                                </div>
                            @endif
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Total Reviews</span>
                                <span class="text-sm text-gray-900">{{ $user->reviews->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                @if($user->orders->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Recent Orders</h2>
                        </div>
                        
                        <div class="divide-y divide-gray-200">
                            @foreach($user->orders->take(5) as $order)
                                <div class="px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                Order #{{ $order->order_number }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ $order->created_at->format('M j, Y') }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-900">
                                                Rp.{{ number_format($order->total_amount, 2) }}
                                            </p>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                                @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                                                @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 