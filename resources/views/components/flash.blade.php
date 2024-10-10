@if (session()->has('success'))
    <div x-data="{show: true}" 
         x-init="setTimeout(() => show = false, 3000)" 
         x-show="show" 
         x-transition.duration.500ms 
         class="fixed bottom-4 left-4 bg-orange-500 shadow-md text-white px-5 py-3 m-5 mb-2"> <!-- Added mb-2 for margin between multiple messages -->
        <p>{{ session('success') }}</p>
    </div>
@endif
