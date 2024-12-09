<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Instagram Clone')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        :root {
            --primary-color: #4F46E5; /* Indigo */
            --secondary-color: #A855F7; /* Purple */
            --text-color: #333333;
            --background-color: #f7f7f7;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- Header -->
<header class="bg-white border-b border-gray-300 fixed top-0 left-0 w-full z-10">
    <div class="container mx-auto px-4 py-4 flex items-center justify-center">
        <h1 class="text-lg font-bold">Treadheat</h1>
    </div>
</header>

<!-- Main Content -->
<main class="pt-20 pb-16">
    @yield('content')
</main>

<!-- Bottom Navigation -->
<nav class="bg-white border-t border-gray-300 fixed bottom-0 left-0 w-full z-10">
    <div class="flex justify-around items-center py-2">
        <a href="/" class="text-gray-800 flex flex-col items-center">
            <x-heroicon-s-home />
            <span class="text-xs">Home</span>
        </a>
        <a href="#" class="text-gray-800 flex flex-col items-center">
            <x-ionicon-search />
            <span class="text-xs">Search</span>
        </a>
        <a href="/post" class="text-gray-800 flex flex-col items-center">
            <x-css-add class="w-8 h-8" />
            <span class="text-xs">Post</span>
        </a>
        <a href="/user-profile" class="text-gray-800 flex flex-col items-center">
            <x-css-profile class="w-8 h-8" />
            <span class="text-xs">Profile</span>
        </a>
    </div>
</nav>
</body>
</html>
