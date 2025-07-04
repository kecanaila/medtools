@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                    Medical Tools & Equipment
                </h1>
                <p class="mt-6 max-w-2xl mx-auto text-xl text-blue-100">
                    Find the best medical tools and equipment from trusted vendors. Quality products for healthcare professionals.
                </p>
                <div class="mt-10">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50">
                        Browse Products
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-gray-50 rounded-lg p-6">
            <form action="{{ route('products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search products..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="sm:w-48">
                    <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Categories</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Search
                </button>
            </form>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Featured Products
            </h2>
            <p class="mt-4 text-lg text-gray-600">
                Discover our most popular medical tools and equipment
            </p>
        </div>

        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-2xl hover:scale-105 transition-transform duration-300">
                        @if($product->linkImage)
                            <img src="{{ $product->linkImage }}" alt="{{ $product->name }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                <a href="{{ route('products.show', $product) }}" class="hover:text-blue-600">
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                {{ Str::limit($product->description, 100) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-blue-600">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                @auth
                                    @if(auth()->user()->isCustomer())
                                        <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" 
                                                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm">
                                                Add to cart
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 text-sm">
                                        Login to Buy
                                    </a>
                                @endauth
                            </div>
                            @if($product->vendor)
                                <div class="mt-2 text-xs text-gray-500">
                                    Sold by: {{ $product->vendor->store_name }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            @if($featuredProducts->count() > 8)
                <div class="mt-8">
                    <!-- Pagination jika ingin -->
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No featured products found</h3>
                <p class="mt-1 text-sm text-gray-500">Try adjusting your featured products in admin/vendor panel.</p>
            </div>
        @endif
    </div>

    <!-- Categories Section -->
    @if(isset($categories) && $categories->count() > 0)
        <div class="bg-gray-50 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        Browse by Category
                    </h2>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($categories as $category)
                        <a href="{{ route('categories.products', $category) }}" 
                           class="bg-white rounded-lg p-6 text-center hover:shadow-md transition-shadow duration-300">
                            <div class="text-2xl font-bold text-blue-600 mb-2">{{ $category->name }}</div>
                            <p class="text-sm text-gray-600">{{ $category->products_count ?? 0 }} products</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Call to Action -->
    <div class="bg-blue-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Ready to start selling?
                </h2>
                <p class="mt-4 text-lg text-blue-100">
                    Join our platform as a vendor and reach thousands of healthcare professionals.
                </p>
                <div class="mt-8">
                    <a href="{{ route('vendor.register') }}" 
                       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50">
                        Become a Vendor
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
