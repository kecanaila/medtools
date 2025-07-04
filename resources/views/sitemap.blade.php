@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Header -->
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900">Sitemap</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Navigate our website easily with our comprehensive sitemap
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Main Pages -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Main Pages</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
                            All Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-blue-600 hover:text-blue-800">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-800">
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('search') }}" class="text-blue-600 hover:text-blue-800">
                            Search Products
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Customer Pages -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Customer Pages</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">
                            Login
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">
                            Register
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cart.view') }}" class="text-blue-600 hover:text-blue-800">
                            Shopping Cart
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800">
                            My Orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">
                            Dashboard
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Vendor Pages -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Vendor Pages</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('vendor.register') }}" class="text-blue-600 hover:text-blue-800">
                            Become a Vendor
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('vendor.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                            Vendor Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('vendor.products.index') }}" class="text-blue-600 hover:text-blue-800">
                            Manage Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('vendor.orders.index') }}" class="text-blue-600 hover:text-blue-800">
                            Manage Orders
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Product Categories -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Product Categories</h2>
                <ul class="space-y-2">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('categories.products', $category) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Legal Pages -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Legal & Information</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('terms') }}" class="text-blue-600 hover:text-blue-800">
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('privacy') }}" class="text-blue-600 hover:text-blue-800">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-800">
                            Support
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Admin Pages -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Admin Pages</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                            Admin Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800">
                            Manage Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800">
                            Manage Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800">
                            Manage Orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:text-blue-800">
                            Manage Categories
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Popular Products -->
        @if(isset($popularProducts) && $popularProducts->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Popular Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($popularProducts as $product)
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <h3 class="font-medium text-gray-900 mb-2">
                                <a href="{{ route('products.show', $product) }}" class="hover:text-blue-600">
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600">
                                ${{ number_format($product->price, 2) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- SEO Information -->
        <div class="mt-12 bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">About This Sitemap</h2>
            <p class="text-gray-600 mb-4">
                This sitemap provides a comprehensive overview of all pages on our medical tools e-commerce platform. 
                It helps users and search engines navigate our website efficiently.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">
                <div>
                    <strong>Total Pages:</strong> {{ $totalPages ?? '50+' }}
                </div>
                <div>
                    <strong>Categories:</strong> {{ $categories->count() }}
                </div>
                <div>
                    <strong>Last Updated:</strong> {{ date('F j, Y') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 