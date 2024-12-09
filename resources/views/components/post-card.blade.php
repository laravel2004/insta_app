<div class="bg-white border border-gray-300 rounded-lg overflow-hidden mb-4">
    <div class="flex items-center p-4">
        <img src="{{ $avatar }}" alt="User Avatar" class="w-10 h-10 rounded-full">
        <div class="ml-3">
            <p class="text-sm font-semibold">{{ $username }}</p>
            <p class="text-xs text-gray-500">{{ $location }}</p>
        </div>
    </div>
    <img src="{{ $image }}" alt="Post Image" class="w-full">
    <div class="p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <button class="mr-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path></svg>
                </button>
                <button>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 20c4.418 0 8-1.79 8-4V6c0-2.21-3.582-4-8-4s-8 1.79-8 4v10c0 2.21 3.582 4 8 4z"></path></svg>
                </button>
            </div>
        </div>
        <p class="mt-4 text-sm"><strong>{{ $username }}</strong> {{ $caption }}</p>
    </div>
</div>
