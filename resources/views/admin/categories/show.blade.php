@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto py-8">
    <div class="bg-white shadow rounded-lg p-8">
        <h1 class="text-xl font-bold mb-6 text-gray-800">Category Details</h1>
        <div class="mb-4">
            <div class="text-gray-700 font-medium">ID:</div>
            <div class="text-gray-900">{{ $category->id }}</div>
        </div>
        <div class="mb-4">
            <div class="text-gray-700 font-medium">Name:</div>
            <div class="text-gray-900">{{ $category->name }}</div>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection 