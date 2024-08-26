<x-layout>
    <div class="relative isolate overflow-hidden py-[120px] sm:py-[200px]">
        <img src="{{Vite::asset('resources/images/header3-slika.jpg') }}" alt=""
            class="absolute inset-0 -z-10 h-full w-full object-cover object-right md:object-center">
    </div>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-4 mt-5 text-black">

        <!-- Filter, sort i search grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <button
                class="bg-gray-200 p-3 flex space-x-2 justify-center items-center hover:bg-gray-300 transition-colors duration-300">
                <img height="40px" src="{{Vite::asset('resources/images/icons/filter-icon.svg') }}" alt="">
                <span>Filtriraj</span>
            </button>

            <button
                class="bg-gray-200 p-3 flex space-x-2 justify-center items-center hover:bg-gray-300 transition-colors duration-300">
                <span>Sortiraj</span>
                <img height="40px" src="{{Vite::asset('resources/images/icons/sort-icon.svg') }}" alt="">
            </button>

            <form class="col-span-2 bg-gray-200 p-3 flex space-x-2">
                <img height="40px" src="{{Vite::asset('resources/images/icons/povecalo.svg') }}" alt="">
                <input class="bg-gray-200 w-full ring-0 placeholder:text-gray-700 border-0 focus:ring-0" type="text"
                    action="POST" placeholder="Pretraži proizvode...">
            </form>
        </div>

        <h3 class="mt-10">Prikazano <strong>25</strong> od <strong>100</strong> rezultata..</h3>

        <!-- Card grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-8 my-5">
            <x-product-card />
            <x-product-card />
            <x-product-card />
            <x-product-card />
            <x-product-card />
            <x-product-card />
            <x-product-card />
            <x-product-card />
        </div>

        <!-- Pagination -->
        <div class="text-center my-10 text-lg">
            Pagination goes here...
        </div>

    </div>
</x-layout>