@extends('layouts.guest')

@section('content')
    <div class="flex items-center justify-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 mr-4" />
        <div>
            <h2 class="text-xl font-bold">Register</h2>
        </div>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div>
            <label for="name">Name</label>
            <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <!-- Email -->
        <div class="mt-4">
            <label for="email">Email</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            @error('email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <!-- Phone -->
        <div class="mt-4">
            <label for="phone">Phone</label>
            <input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ old('phone') }}" autocomplete="tel" />
            @error('phone')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <!-- Address -->
        <div class="mt-4">
            <label for="address">Address</label>
            <textarea id="address" class="block mt-1 w-full" name="address" rows="2">{{ old('address') }}</textarea>
            @error('address')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <!-- Password -->
        <div class="mt-4">
            <label for="password">Password</label>
            <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <button type="submit" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded">Register</button>
        </div>
    </form>
@endsection
