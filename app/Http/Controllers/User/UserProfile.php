<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class UserProfile extends Controller
{

    private Setting $settings;
    public function __construct(Setting $settings)
    {
        $this->settings = $settings;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $posts = Post::where('user_id', $user->id)->get();
        $postCount = $posts->count();
        $settings = $this->settings->where('user_id', $user->id)->with('user')->first();
        return view('user-profile.index', compact('settings', 'posts', 'postCount'));
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $settings = $this->settings->where('user_id', $user->id)->first();

        if (!$settings) {
            return response()->json(['message' => 'Settings not found'], 404);
        }

        $validated = $request->validate([
            'private' => 'required|boolean',
            'bio' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
        ]);

        try {
            // Process the uploaded image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);
                $validated['image'] = $imageName;
            }

            $settings->update([
                'private' => $validated['private'],
                'bio' => $validated['bio'],
                'image' => $validated['image'] ?? $settings->image,
            ]);

            $user->update([
                'name' => $validated['name'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Settings updated successfully',
                'name' => $user->name,
                'bio' => $settings->bio,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
