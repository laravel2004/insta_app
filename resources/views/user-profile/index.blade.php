@extends('layout.master')

@section('title', 'User Profile')

@section('content')
    <div class="container mx-auto px-4">
        <!-- User Info -->
        <div class="bg-white shadow-md px-6 py-4 rounded-lg">
            <div class="flex flex-col sm:flex-row items-center">
                <!-- Profile Image -->
                <div class="w-24 h-24 rounded-full overflow-hidden mb-4 sm:mb-0 sm:mr-6">
                    @if($settings->image)
                        <img id="userPhoto" src="{{ asset('images/' . $settings->image) }}" alt="Profile Image" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('assets/logo.jpg') }}" alt="Profile Picture" class="w-full h-full object-cover">
                    @endif
                </div>
                <!-- Profile Info -->
                <div>
                    <h1 id="nameUser" class="text-2xl font-semibold">{{ $settings->user->name }}</h1>
                    <div class="flex flex-wrap items-center space-x-6 mt-2 text-sm sm:text-base">
                        <span class="text-gray-600">{{ $postCount }} Posts</span>
                        <span class="text-gray-600">{{ $settings->followers }} Followers</span>
                        <span class="text-gray-600">{{ $settings->following }} Following</span>
                    </div>
                    <p id="userBio" class="text-gray-600 mt-2">
                        @if($settings->bio)
                            {{ $settings->bio }}
                        @else
                            No bio available
                        @endif
                    </p>
                    <div class="mt-4 flex flex-col sm:flex-row gap-4">
                        <!-- Edit Button -->
                        <button
                            data-modal-target="editModal"
                            data-modal-toggle="editModal"
                            class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                            Edit Settings
                        </button>
                        <!-- Logout Button -->
                        <form action="{{ route('logout') }}" method="POST" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 w-full sm:w-auto">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Posts -->
        @if($posts->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6">
                @foreach($posts as $post)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h1 class="text-xl font-semibold">{{ $post->title }}</h1>
                            <p class="text-gray-600 mt-2">{{ $post->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 mt-6 text-center">No posts available</p>
        @endif

        <!-- Modal for Edit Settings -->
        <div id="editModal" tabindex="-1" class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 w-full h-full bg-gray-800 bg-opacity-50">
            <div class="relative w-full max-w-2xl mx-auto mt-20 bg-white rounded-lg shadow-lg">
                <form id="editSettingsForm">
                    @csrf
                    <!-- Modal Header -->
                    <div class="flex justify-between items-center p-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Edit Settings</h3>
                        <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-hide="editModal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="p-4">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" name="name" value="{{ $settings->user->name }}" class="block w-full mt-1 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300">
                        </div>
                        <div class="mb-4">
                            <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                            <textarea id="bio" name="bio" rows="3" class="block w-full mt-1 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300">{{ $settings->bio }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="private" class="block text-sm font-medium text-gray-700">Private Account</label>
                            <select
                                id="private"
                                name="private"
                                class="block w-full mt-1 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300"
                            >
                                <option value="1" {{ $settings->private ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$settings->private ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Profile Image</label>
                            <input type="file" id="image" name="image" class="block w-full mt-1 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300">
                        </div>
                        <div class="mb-4">
                            @if($settings->image)
                                <img src="{{ asset('images/' . $settings->image) }}" alt="Profile Image" class="w-24 h-24 object-cover">
                            @endif
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="flex items-center p-4 border-t border-gray-200">
                        <button type="button" onclick="updateSettings()" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Save</button>
                        <button type="button" class="ml-2 bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300" data-modal-hide="editModal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateSettings() {
            let form = document.getElementById('editSettingsForm');
            let formData = new FormData(form);

            fetch("{{ route('user-profile.update') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Success...",
                            text: "Successfull update setting!",
                        });
                        document.querySelector("[data-modal-hide='editModal']").click();
                        form.reset();
                        window.location.reload();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                });
        }
    </script>
@endsection
