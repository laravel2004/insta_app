@extends('layout.master')

@section('title', 'Create Post')

@section('content')
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Create a New Post</h2>

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-500 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Image Preview -->
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" id="image" name="image" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" accept="image/*" required onchange="previewImage(event)">
                </div>

                <!-- Image Preview Display -->
                <div class="mb-4">
                    <div id="imagePreview" class="w-full h-48 bg-gray-200 rounded-md flex items-center justify-center text-gray-500">
                        <span>No image selected</span>
                    </div>
                </div>

                <!-- Caption -->
                <div class="mb-4">
                    <label for="caption" class="block text-sm font-medium text-gray-700">Caption</label>
                    <textarea id="caption" name="caption" rows="3" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('caption') }}</textarea>
                </div>

                <!-- Location (Optional) -->
                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700">Location (Optional)</label>
                    <input type="text" id="location" name="location" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('location') }}">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Post</button>
            </form>
        </div>
    </div>

    <script>
        // Function to preview the selected image before uploading
        function previewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.innerHTML = `<img src="${e.target.result}" alt="Image Preview" class="w-full h-full object-cover rounded-md">`;
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = `<span>No image selected</span>`;
            }
        }
    </script>
@endsection
