<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);  // Find the post by its ID
        return view('blog-show', compact('post'));  // Return the 'show' view with the post data
    }
}