<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Fetch all posts
        $posts = Post::all(); // or use paginate() for pagination
    
        return view('post-index', compact('posts'));
    }

    public function create()
    {
        return view('post-form');
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);
    
        // Handle file upload for image if present
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $validatedData['image_url'] = '/storage/' . $path;
        }
    
        // Add the user_id field to the validated data
        $validatedData['user_id'] = auth()->id(); // Assuming user authentication is required
    
        // Create the post with the validated data
        Post::create($validatedData);
    
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    
    public function like(Post $post)
    {
        $post->increment('likes_count');
        return back();
    }
}
