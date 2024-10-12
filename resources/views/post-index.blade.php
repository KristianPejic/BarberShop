<x-layout>
    <!-- Blog Posts Section -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6 text-center text-black">Blog Posts</h2>
    
        <!-- Show 'Create Post' button for Admins only -->
        @auth
            @if(Auth::user()->admin)
                <div class="fixed bottom-8 right-8">
                    <a href="{{ route('posts.create') }}" 
                       class="bg-orange-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-orange-700 transition-all">
                       + Create Post
                    </a>
                </div>
            @endif
        @endauth
    
        @if ($posts->isEmpty())
            <p class="text-center text-black">No blog posts available yet.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded-lg mb-4">
                        <h3 class="text-xl font-bold mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-700 mb-4">{{ Str::limit($post->content, 150) }}</p>
                        <a href="{{ route('blog.show', $post->id) }}" class="text-orange-500 hover:underline">Read More</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    

</x-layout>
