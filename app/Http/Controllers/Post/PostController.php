<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(Request $request)
    {
        $posts = $this->post->with('user.setting')->latest()->paginate(15);

        if ($request->ajax()) {
            return view('welcome', compact('posts'))->render();
        }

        return view('welcome', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('posts', 'public');

        $this->post->create([
            'user_id' => auth()->id(),
            'caption' => $request->caption,
            'image' => $path,
            'location' => $request->location,
        ]);

        return redirect()->route('post.index')->with('success', 'Post created successfully!');
    }
}
