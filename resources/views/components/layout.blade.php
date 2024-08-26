<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Berik's Barbershop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
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
            <div class="space-x-6 items-center hidden md:block">
                <a href="/" class="hover:text-orange-500 transition-colors duration-300">Početna</a>
                <a href="#" class="hover:text-orange-500 transition-colors duration-300">Rezervacije</a>
                <a href="/shop" class="hover:text-orange-500 transition-colors duration-300">Shop</a>
                <a href="#" class="hover:text-orange-500 transition-colors duration-300">Blog</a>
            </div>
            @guest
                <div class="space-x-5 hidden md:block">
                    <a href="/login">Login</a>
                    <a href="/register">Register</a>
                </div>
            @endguest   

            @auth
                <div class="space-x-6 hidden md:flex">
                    <a href="/dashboard">Dashboard</a>
                    <form action="/logout" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Log Out</button>
                    </form>
                </div>
            @endauth

            <!-- Menu button for small screens -->
            <div class="md:hidden">
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
        </div>
    </nav>

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
            <x-offset-navlink link="/">Rezervacije</x-offset-navlink>
            <x-offset-navlink link="/shop">Shop</x-offset-navlink>
            <x-offset-navlink link="/">Blog</x-offset-navlink>
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
                <div
                    class="border-2 border-transparent hover:border-orange-500 hover:bg-gray-50 px-6 py-4 transition-colors duration-300">
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

    <!-- Content goes in here -->
    <div>
        {{$slot}}
    </div>

    <!-- Footer -->
    <footer>
        <div class="bg-black">
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
                                <li class="font-bold">Berikiko d.o.o.</li>
                                <li>Adresa bb, 71250 Kiseljak</li>
                                <li>Tel: +387 (0)63 123 456</li>
                                <a href="mailto:teo@zad.ba">
                                    <li>info@berikiko.ba</li>
                                </a>
                            </ul>
                        </div>
                        <div class="flex flex-col mx-auto space-y-1">
                            <a href="/" class="hover:text-orange-500 transition-colors duration-300">Početna</a>
                            <a href="#" class="hover:text-orange-500 transition-colors duration-300">Rezervacije</a>
                            <a href="/shop" class="hover:text-orange-500 transition-colors duration-300">Shop</a>
                            <a href="#" class="hover:text-orange-500 transition-colors duration-300">Blog</a>
                        </div>
                    </div>
                </div>

                <div class="text-center space-y-1 text-sm px-5 md:px-12">
                    <h6 class="font-extrabold hover:text-orange-500 transition-colors duration-300">©2024 <a
                            href="/">Berik's Barbershop</a></h6>
                    <section class="font-light">
                        <a href="#">Pravila o zaštiti privatnosti</a>
                        <span> | </span>
                        <a href="#">Politika o kolačićima</a>
                        <span> | </span>
                        <a href="#">Uvjeti korištenja</a>

                    </section>
                </div>
            </div>
        </div>
    </footer>

    <!-- TW Elements (used for offcanvas-right) -->
    <script type="text/javascript" src="../node_modules/tw-elements/dist/js/tw-elements.umd.min.js">
    </script>
</body>

</html>