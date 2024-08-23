<div>
    <div class="bg-black">
        <nav class="flex justify-between items-center font-light text-lg mx-auto max-w-7xl px-6 lg:px-8 py-4">
            <div class="-mt-1">
                <a href="/">
                    <img width="150" src="{{Vite::asset('resources/images/barbershop-logo.svg') }}" alt="logo">
                </a>
            </div>
            <div class="space-x-6 items-center hidden md:block">
                <a href="/">Home</a>
                <a href="#">Rezervacije</a>
                <a href="#">Store</a>
                <a href="#">Blog</a>
            </div>
            @guest
                <div class="space-x-5 hidden md:block">
                    <a href="/login">Login</a>
                    <a href="/register">Register</a>
                </div>
            @endguest   

            @auth
                <div class="space-x-5 hidden md:block">
                    <form action="/logout" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Log Out</button>
                    </form>
                </div>
            @endauth


            <div class="md:hidden">
                <button class="bg-orange-500 text-white px-4 py-2 rounded" type="button" data-twe-offcanvas-toggle
                    data-twe-target="#offcanvasRight" aria-controls="offcanvasRight" data-twe-ripple-init
                    data-twe-ripple-color="light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-menu">
                        <line x1="4" x2="20" y1="12" y2="12" />
                        <line x1="4" x2="20" y1="6" y2="6" />
                        <line x1="4" x2="20" y1="18" y2="18" />
                    </svg>
                </button>
            </div>
        </nav>
    </div>

    <!-- Offcanvas right component -->
    <div class="invisible fixed bottom-0 right-0 top-0 z-[1045] flex w-96 max-w-full translate-x-full flex-col border-none bg-white bg-clip-padding text-neutral-700 shadow-sm outline-none transition duration-300 ease-in-out data-[twe-offcanvas-show]:transform-none dark:bg-body-dark dark:text-white"
        tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" data-twe-offcanvas-init>
        <div class="flex items-center justify-between p-6">
            <h5 class="mb-0 font-semibold text-xl leading-normal" id="offcanvasRightLabel">
                Berik's Barbershop
            </h5>
            <button type="button"
                class="box-content rounded-none border-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                data-twe-offcanvas-dismiss aria-label="Close">
                <span class="[&>svg]:h-8 [&>svg]:w-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </button>
        </div>
        <div class="offcanvas-body flex flex-col overflow-y-auto text-lg mt-5">
            <x-offset-navlink link="/">Home</x-offset-navlink>
            <x-offset-navlink link="/">Rezervacije</x-offset-navlink>
            <x-offset-navlink link="/">Shop</x-offset-navlink>
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

    <div>
        {{$slot}}
    </div>
</div>