@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
            <p class="mt-2 text-sm text-gray-600">
                Review your items and proceed to checkout
            </p>
        </div>

        @if($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white border border-gray-200 rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Cart Items ({{ $cartItems->count() }})</h2>
                        </div>
                        
                        <div class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <div class="px-6 py-4">
                                    <div class="flex items-center">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0 w-20 h-20">
                                            @if($item->product->linkImage)
                                                <img src="{{ $item->product->linkImage }}" alt="{{ $item->product->name }}" 
                                                     class="w-full h-full object-cover rounded-md">
                                            @else
                                                <div class="w-full h-full bg-gray-200 rounded-md flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="ml-4 flex-1">
                                            <div class="flex justify-between">
                                                <div>
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        <a href="{{ route('products.show', $item->product) }}" class="hover:text-blue-600">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h3>
                                                    <p class="text-sm text-gray-600">
                                                        {{ Str::limit($item->product->description, 100) }}
                                                    </p>
                                                    @if($item->product->vendor)
                                                        <p class="text-xs text-gray-500 mt-1">
                                                            Sold by: {{ $item->product->vendor->store_name }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-lg font-medium text-blue-600">
                                                        Rp.{{ number_format($item->product->price, 2) }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        Stock: {{ $item->product->stock }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Quantity and Actions -->
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="flex items-center space-x-3">
                                                    <label for="quantity-{{ $item->id }}" class="text-sm font-medium text-gray-700">Qty:</label>
                                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <select name="quantity" id="quantity-{{ $item->id }}" 
                                                                onchange="this.form.submit()"
                                                                class="w-16 px-2 py-1 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
                                                            @for($i = 1; $i <= min(10, $item->product->stock); $i++)
                                                                <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>
                                                                    {{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </form>
                                                </div>

                                                <div class="flex items-center space-x-2">
                                                    <span class="text-lg font-medium text-gray-900">
                                                        Rp.{{ number_format($item->product->price * $item->quantity, 2) }}
                                                    </span>
                                                    
                                                    <form action="{{ route('cart.remove', $item) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="text-red-600 hover:text-red-800 text-sm font-medium"
                                                                onclick="return confirm('Are you sure you want to remove this item?')">
                                                            Remove
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Cart Actions -->
                        <div class="px-6 py-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-gray-600 hover:text-gray-800 text-sm font-medium"
                                            onclick="return confirm('Are you sure you want to clear your cart?')">
                                        Clear Cart
                                    </button>
                                </form>
                                
                                <a href="{{ route('products.index') }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white border border-gray-200 rounded-lg p-6 sticky top-4">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                                <span class="text-gray-900">Rp.{{ number_format($cart->getTotalAmount(), 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Shipping</span>
                                <span class="text-gray-900">Free</span>
                            </div>
                            
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tax</span>
                                <span class="text-gray-900">Rp.{{ number_format($cart->getTotalAmount() * 0.11, 2) }}</span>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between text-lg font-medium">
                                    <span class="text-gray-900">Total</span>
                                    <span class="text-blue-600">Rp.{{ number_format($cart->getTotalAmount() * 1.11, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('checkout.index') }}" 
                               class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 font-medium text-center block">
                                Proceed to Checkout
                            </a>
                        </div>

                        <div class="mt-4 text-center">
                            <p class="text-xs text-gray-500">
                                By proceeding, you agree to our Terms of Service and Privacy Policy
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m6 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Your cart is empty</h3>
                <p class="mt-1 text-sm text-gray-500">Start shopping to add items to your cart.</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Browse Products
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 