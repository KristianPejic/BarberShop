<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6 text-center text-black">{{ $post->title }}</h2>
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-96 object-cover rounded-lg mb-6">
        <p class="text-gray-700">{{ $post->content }}</p>

        <!-- Like Button -->
        <div class="mt-4">
            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-700">Like</button>
        </div>
    </div>
</x-layout>