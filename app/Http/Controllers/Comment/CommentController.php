<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function index(Request $request)
    {
        $comments = $this->comment->with('user.setting')->where('post_id', $request->post_id)->latest()->get();

        return response()->json([
            'comments' => $comments
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = $this->comment->create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'comment' => $request->comment,
        ]);

        $post = Post::find($request->post_id);
        if ($post) {
            $post->comments += 1;
            $post->save();
        }

        return response()->json([
            'comment' => $comment->load('user')
        ]);
    }

}
