<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Berik's Barbershop</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
    <link rel="icon" type="image/x-icon" href="{{Vite::asset('resources/images/barbershop-logo.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
</head>

<body class="font-poppins text-white">
    <!-- Navigation -->
    <nav class="bg-black">
        <div class="flex justify-between items-center font-light lg:text-lg mx-auto max-w-7xl px-6 lg:px-8 py-4">
            <div class="-mt-1">
                <a href="/">
                    <img width="150" src="{{Vite::asset('resources/images/barbershop-logo.svg') }}" alt="logo">
                </a>
            </div>
            <div class="space-x-6 items-center hidden lg:block">
                <a href="/" class="hover:text-orange-500 transition-colors duration-300">Početna</a>
                <a href="/reservations" class="hover:text-orange-500 transition-colors duration-300">Rezervacije</a>
                <a href="/shop" class="hover:text-orange-500 transition-colors duration-300">Shop</a>
                <a href="/posts" class="hover:text-orange-500 transition-colors duration-300">Blog</a>
            </div>
            
           <!-- Cart Icon in Navigation -->
<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="relative">
        <img src="https://img.icons8.com/ios-filled/50/ffffff/shopping-cart.png" alt="Cart" class="w-6 h-6">
        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full w-5 h-5 text-center cart-count">
            {{ count(session('cart', [])) }}
        </span>
    </button>

   <!-- Cart Dropdown -->
<div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-lg p-4 z-10 cart-dropdown">
    @if(session('cart') && count(session('cart')) > 0)
    <ul>
        @foreach(session('cart') as $id => $details)
            <li class="flex justify-between py-2 border-b">
                <div class="flex items-center">
                    <img src="{{ $details['photo'] }}" class="w-12 h-12 mr-3">
                    <div>
                        <h5 class="text-black">{{ $details['name'] }}</h5>
                        <small class="text-black">{{ number_format($details['price'], 2) }} KM</small>
                    </div>
                </div>
                <button class="text-red-500 hover:underline" onclick="removeFromCart({{ $id }})">&times;</button>
            </li>
        @endforeach
    </ul>
    
        <div class="text-right mt-4 z-20">
            <strong class="text-black">Total: 
                <span class="cart-total">
                    {{ array_sum(array_map(function($item) {
                        return (float) $item['price']; // Ensure quantity is multiplied by the price
                    }, session('cart', []))) }} KM
                </span>
            </strong>            
        </div>
        <a href="{{ route('user_orders') }}" class="block bg-orange-500 text-white text-center py-2 rounded mt-4">Proceed to Order</a>
    @else
        <p class="text-center text-gray-500">Your cart is empty</p>
    @endif
</div>

</div>

            @guest
                <div class="space-x-5 hidden lg:block">
                    <a href="/login">Login</a>
                    <a href="/register">Register</a>
                </div>
            @endguest   

            @auth
                <div class="space-x-6 hidden lg:flex">
                    <a href="/dashboard">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            @endauth

          <!-- Menu button for small screens -->
<div class="lg:hidden">
    <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded" type="button"
        data-twe-offcanvas-toggle data-twe-target="#offcanvasRight" aria-controls="offcanvasRight"
        data-twe-ripple-init data-twe-ripple-color="light">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-menu">
            <line x1="4" x2="20" y1="12" y2="12" />
            <line x1="4" x2="20" y1="6" y2="6" />
            <line x1="4" x2="20" y1="18" y2="18" />
        </svg>
    </button>
</div>

<!-- Offcanvas-right component -->
<div class="invisible fixed bottom-0 right-0 top-0 z-[1045] flex w-96 max-w-full translate-x-full flex-col border-none bg-white bg-clip-padding text-neutral-700 shadow-sm outline-none transition duration-300 ease-in-out data-[twe-offcanvas-show]:transform-none dark:bg-body-dark dark:text-white"
    tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" data-twe-offcanvas-init>
    <div class="flex items-center justify-between p-6">
        <h5 class="mb-0 font-semibold text-xl leading-normal" id="offcanvasRightLabel">
            Berik's Barbershop
        </h5>
        <button type="button"
            class="box-content rounded-none border-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
            data-twe-offcanvas-dismiss aria-label="Close">
            <span class="[&>svg]:h-6 [&>svg]:w-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </button>
    </div>

    <!-- Offcanvas-right menu items -->
    <div class="offcanvas-body flex flex-col overflow-y-auto text-lg mt-5">
        <x-offset-navlink link="/">Početna</x-offset-navlink>
        <x-offset-navlink link="/reservations">Rezervacije</x-offset-navlink>
        <x-offset-navlink link="/shop">Shop</x-offset-navlink>
        <x-offset-navlink link="/posts">Blog</x-offset-navlink>
    </div>
    @guest
    <div class="offcanvas-body flex flex-col overflow-y-auto text-lg mt-auto mb-6">
        <x-offset-navlink link="/login">Log in</x-offset-navlink>
        <x-offset-navlink link="/register">Register</x-offset-navlink>
    </div>
    @endguest

    @auth
    <div class="offcanvas-body flex flex-col overflow-y-auto text-lg mt-auto mb-6">
        <x-offset-navlink link="/dashboard">Dashboard</x-offset-navlink>
        <div class="border-2 border-transparent hover:border-orange-500 hover:bg-gray-50 px-6 py-4 transition-colors duration-300">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
    @endauth
</div>

    </nav>

    <!-- Content goes here -->
    <div>
        {{$slot}}
    </div>

    <!-- Footer -->
    <footer class="bg-black">
        <div class="mx-auto max-w-8xl px-6 lg:px-8 flex flex-col py-10 font-light space-y-5">
            <div class="grid md:grid-cols-5 justify-center space-y-8 mb-7 items-center">
                <div class="md:col-span-2 flex justify-center">
                    <a href="/">
                        <img width="200" src="{{Vite::asset('resources/images/barbershop-logo.svg') }}" alt="logo">
                    </a>
                </div>
                <div class="flex lg:pl-10 gap-10 md:col-span-3 sm:text-lg pt-4 md:pt-0">
                    <div>
                        <ul class="space-y-1">
                            <li class="font-bold">kiko d.o.o.</li>
                            <li>Adresa bb, Grude 88340</li>
                            <li>Tel: +387 (0)63 123 456</li>
                            <a href="mailto:kristian.pejic@fpmoz.sum.ba">
                                <li>kristian.pejic@fpmoz.sum.ba</li>
                            </a>
                        </ul>
                    </div>
                    <div class="flex flex-col mx-auto space-y-1">
                        <a href="/" class="hover:text-orange-500 transition-colors duration-300">Početna</a>
                        <a href="/reservations" class="hover:text-orange-500 transition-colors duration-300">Rezervacije</a>
                        <a href="/shop" class="hover:text-orange-500 transition-colors duration-300">Shop</a>
                        <a href="/posts" class="hover:text-orange-500 transition-colors duration-300">Blog</a>
                    </div>
                </div>
            </div>

            <div class="text-center space-y-1 text-sm px-5 md:px-12">
                <h6 class="font-extrabold hover:text-orange-500 transition-colors duration-300">©2024 <a href="/">Berik's Barbershop</a></h6>
                <section class="font-light">
                    <a href="#">Pravila o zaštiti privatnosti</a>
                    <span> | </span>
                    <a href="#">Politika o kolačićima</a>
                    <span> | </span>
                    <a href="#">Uvjeti korištenja</a>
                </section>
            </div>
        </div>
    </footer>

    <x-flash />
    <script>
        function removeFromCart(id) {
    fetch(`/cart/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const flashMessage = document.createElement('div');
            flashMessage.classList.add('fixed', 'bottom-4', 'left-4', 'bg-orange-500', 'text-white', 'py-2', 'px-4', 'rounded', 'shadow-lg');
            flashMessage.innerHTML = data.success;
            document.body.appendChild(flashMessage);

            setTimeout(() => { flashMessage.remove(); window.location.reload(); }, 1500);

            // Update the cart dynamically without reloading
            updateCartDropdown(data.cart);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
    </script>
</body>

</html>
