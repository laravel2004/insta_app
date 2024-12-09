<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Treadheat</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Custom Colors */
        :root {
            --primary-color: #4F46E5; /* Indigo */
            --secondary-color: #A855F7; /* Purple */
            --text-color: #333333;
            --background-blur: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="h-screen w-full bg-cover bg-center" style="background-image: url('{{ asset('assets/background.jpg') }}');">
<!-- Overlay Blur -->
<div class="h-full w-full" style="background-color: var(--background-blur); backdrop-filter: blur(5px);">
    <div class="h-full w-full flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg flex overflow-hidden max-w-4xl">
            <!-- Bagian Gambar -->
            <div class="hidden md:block md:w-1/2 bg-gray-200">
                <img src="{{ asset('assets/logo.jpg') }}" alt="Login Image" class="w-72 h-96 object-cover">
            </div>

            <!-- Bagian Form -->
            <div class="w-full md:w-1/2 p-8 flex flex-col items-center justify-center">
                <h1 class="text-3xl font-bold text-center mb-4 text-indigo-600">Treadheat</h1>
                <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm">
                    @csrf
                    <div class="mb-4">
                        <input type="email" name="email" placeholder="Email"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" placeholder="Password"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <button type="submit"
                            class="w-full bg-indigo-600 text-white py-2 rounded-lg font-bold hover:bg-indigo-700 transition">Log In</button>
                </form>
                <div class="mt-4 text-center text-sm">
                    <a href="#" class="text-purple-500 hover:underline">Forgot password?</a>
                </div>
                <div class="mt-6 border-t pt-4 text-center">
                    <p class="text-sm text-gray-700">Don't have an account?
                        <a href="{{ route('register') }}" class="text-purple-500 font-bold hover:underline">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
