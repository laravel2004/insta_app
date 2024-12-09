@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4">
        <div class="bg-white shadow-md px-6 py-4 rounded-lg">
            <div class="flex flex-col sm:flex-row items-center">
                <!-- Profile Image -->
                <div class="w-24 h-24 rounded-full overflow-hidden mb-4 sm:mb-0 sm:mr-6">
                    <img src="{{ asset('assets/logo.jpg') }}" alt="Profile Picture" class="w-full h-full object-cover">
                </div>
                <!-- Profile Info -->
                <div>
                    <h1 class="text-2xl font-semibold">John Doe</h1>
                    <div class="flex flex-wrap items-center space-x-6 mt-2 text-sm sm:text-base">
                        <span class="text-gray-600">100 Posts</span>
                        <span class="text-gray-600">200 Followers</span>
                        <span class="text-gray-600">180 Following</span>
                    </div>
                    <p class="text-gray-600 mt-2">Loving life, sharing moments.</p>
                    <div class="mt-4">
                        <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 w-full sm:w-auto">Follow</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid of Posts -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 gap-2 p-6">
            <div class="w-full h-60 bg-gray-300 rounded-md overflow-hidden">
                <img src="{{ asset('assets/background.jpg') }}" alt="Post Image" class="w-full h-full object-cover">
            </div>
            <div class="w-full h-60 bg-gray-300 rounded-md overflow-hidden">
                <img src="{{ asset('assets/logo.jpg') }}" alt="Post Image" class="w-full h-full object-cover">
            </div>
            <div class="w-full h-60 bg-gray-300 rounded-md overflow-hidden">
                <img src="{{ asset('assets/background.jpg') }}" alt="Post Image" class="w-full h-full object-cover">
            </div>
            <div class="w-full h-60 bg-gray-300 rounded-md overflow-hidden">
                <img src="{{ asset('assets/logo.jpg') }}" alt="Post Image" class="w-full h-full object-cover">
            </div>
            <div class="w-full h-60 bg-gray-300 rounded-md overflow-hidden">
                <img src="{{ asset('assets/background.jpg') }}" alt="Post Image" class="w-full h-full object-cover">
            </div>
            <div class="w-full h-60 bg-gray-300 rounded-md overflow-hidden">
                <img src="{{ asset('assets/logo.jpg') }}" alt="Post Image" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
@endsection
