@props(['link' => '#'])

<a href="{{$link}}">
    <div
        class="border-2 border-transparent hover:border-orange-500 hover:bg-gray-50 px-6 py-4 transition-colors duration-300">
        {{$slot}}
    </div>
</a>