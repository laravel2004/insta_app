@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4" id="posts-container">
        @foreach ($posts as $post)
            <div id="post-card-{{ $post->id }}" class="bg-white border border-gray-300 rounded-lg overflow-hidden mb-4">
                <div class="flex items-center p-4">
                    <img
                        src="{{ $post->user->setting && $post->user->setting->image ? asset('images/' . $post->user->setting->image) : asset('assets/logo.jpg') }}"
                        alt="User Avatar"
                        class="w-10 h-10 rounded-full"
                    >
                    <div class="ml-3">
                        <p class="text-sm font-semibold">{{ $post->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $post->location }}</p>
                    </div>
                </div>
                <img
                    src="{{ asset('storage/' . $post->image) }}"
                    data-modal-target="editModal"
                    data-modal-toggle="editModal"
                    alt="Post Image"
                    class="w-full"
                >
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <button class="mr-2">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                                </svg>
                            </button>
                            <button
                                data-modal-target="editModal"
                                data-modal-toggle="editModal"
                                class="inline-flex items-center space-x-2"
                            >
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 20c4.418 0 8-1.79 8-4V6c0-2.21-3.582-4-8-4s-8 1.79-8 4v10c0 2.21 3.582 4 8 4z"></path>
                                </svg>
                                <span>{{ $post->comments }}</span>
                            </button>

                        </div>
                    </div>
                    <p class="mt-4 text-sm">
                        <strong>{{ $post->user->name }}</strong> {{ $post->caption }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Loading Spinner -->
    <div id="loading" class="text-center py-4 hidden">
        <span class="text-gray-500">Loading...</span>
    </div>

    <!-- Modal for Comment -->
    <div id="editModal" tabindex="-1" class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 w-full h-full bg-gray-800 bg-opacity-50">
        <div class="relative w-full max-w-2xl mx-auto mt-20 bg-white rounded-lg shadow-lg">
            <form id="editSettingsForm">
                @csrf
                <!-- Modal Header -->
                <div class="flex justify-between items-center p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900">Komentar</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-hide="editModal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="p-4">
                    <!-- Daftar Komentar -->
                    <div id="comments-list" class="max-h-60 overflow-y-auto mb-4">
                        <!-- Komentar akan ditambahkan di sini melalui JavaScript -->
                    </div>

                    <!-- Add Comment Form -->
                    <div class="mt-4">
                        <textarea id="commentText" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Tulis komentar..."></textarea>
                        <button type="button" id="submitComment" class="bg-blue-500 text-white py-2 px-4 rounded-md mt-2 hover:bg-blue-600 focus:outline-none w-full">Kirim Komentar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let page = 1;
        let loading = false;

        window.addEventListener('scroll', function () {
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

                    // Re-bind event listeners for newly loaded posts
                    bindModalEvents();
                })
                .catch(error => {
                    console.error('Error:', error);
                    loading = false;
                    document.getElementById('loading').classList.add('hidden');
                });
        }

        // Function to bind the modal open event to each post card
        function bindModalEvents() {
            document.querySelectorAll('[id^="post-card-"]').forEach(card => {
                card.addEventListener('click', () => {
                    const postId = card.id.split('-').pop(); // Ambil ID postingan
                    openModal(postId);
                });
            });

            // Close modal when the close button is clicked
            const closeModalButton = document.querySelector('[data-modal-hide="editModal"]');
            if (closeModalButton) {
                closeModalButton.addEventListener('click', () => {
                    closeModal();
                    window.location.reload();
                });
            }

            const modal = document.getElementById('editModal');
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                    window.location.reload();
                }
            });
        }

        function openModal(postId) {
            document.getElementById('editModal').classList.remove('hidden');

            fetch(`/comments?post_id=${postId}`)
                .then(response => response.json())
                .then(data => {
                    const commentsList = document.getElementById('comments-list');
                    commentsList.innerHTML = '';

                    data.comments.forEach(comment => {
                        let commentDiv = document.createElement('div');
                        commentDiv.classList.add('mb-4', 'p-2', 'bg-gray-100', 'rounded-md');
                        commentDiv.innerHTML = `
                    <p class="font-semibold">${comment.user.name}</p>
                    <p class="text-sm text-gray-600">${comment.comment}</p>
                `;
                        commentsList.appendChild(commentDiv);
                    });
                })
                .catch(error => console.error('Error fetching comments:', error));

            document.getElementById('submitComment').addEventListener('click', () => {
                const commentText = document.getElementById('commentText').value;

                if (commentText.trim() === '') {
                    alert('Komentar tidak boleh kosong');
                    return;
                }

                fetch(`/comments/store`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        post_id: postId,
                        comment: commentText
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        const newCommentDiv = document.createElement('div');
                        newCommentDiv.classList.add('mb-4', 'p-2', 'bg-gray-100', 'rounded-md');
                        newCommentDiv.innerHTML = `
                    <p class="font-semibold">${data.comment.user.name}</p>
                    <p class="text-sm text-gray-600">${data.comment.comment}</p>
                `;
                        document.getElementById('comments-list').prepend(newCommentDiv);
                        document.getElementById('commentText').value = '';
                    })
                    .catch(error => console.error('Error submitting comment:', error));
            });
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        bindModalEvents();
    </script>
@endsection
