@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4" id="posts-container">
        @foreach ($posts as $post)
            <x-post-card
                avatar="{{ $post->user->setting && $post->user->setting->image ? asset('images/' . $post->user->setting->image) : asset('assets/logo.jpg') }}"
                username="{{ $post->user->name }}"
                location="{{ $post->location }}"
                image="{{ asset('storage/' . $post->image) }}"
                caption="{{ $post->caption }}"
            />
        @endforeach
    </div>

    <!-- Loading Spinner -->
    <div id="loading" class="text-center py-4 hidden">
        <span class="text-gray-500">Loading...</span>
    </div>

    <script>
        let page = 1;
        let loading = false;

        window.addEventListener('scroll', function() {
            if (loading) return;

            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
                loading = true;
                console.log('Load more posts');
                loadMorePosts();
            }
        });

        function loadMorePosts() {
            page++;

            // Menampilkan loading spinner
            document.getElementById('loading').classList.remove('hidden');

            fetch(`/posts?page=${page}`)
                .then(response => response.text())
                .then(data => {
                    // Tambahkan postingan baru ke container
                    const postsContainer = document.getElementById('posts-container');
                    postsContainer.innerHTML += data;

                    document.getElementById('loading').classList.add('hidden');

                    loading = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    loading = false;
                    document.getElementById('loading').classList.add('hidden');
                });
        }
    </script>
@endsection
