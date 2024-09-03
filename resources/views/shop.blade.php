<x-layout>
    <div class="relative isolate overflow-hidden py-[120px] sm:py-[200px]">
        <img src="{{Vite::asset('resources/images/header3-slika.jpg') }}" alt=""
            class="absolute inset-0 -z-10 h-full w-full object-cover object-right md:object-center">
    </div>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-4 mt-5 text-black">

        <!-- Filter, sort i search grid -->
        <div class="grid sm:grid-cols-2 gap-4">
            <div x-data="{show: false}" @click.away="show = false" class="">
                <button @click="show = ! show" class="bg-gray-200 p-3 flex space-x-2 justify-center items-center hover:bg-gray-300
                    transition-colors w-full duration-300">
                    <img height="40px" src="{{Vite::asset('resources/images/icons/filter-icon.svg') }}" alt="">
                    <span>Filtriraj</span>
                </button>

                <div x-show="show"
                    class="mt-3 justify-center z-50 bg-gray-200 sm:absolute sm:w-[90%] lg:w-[39.5%] text-center"
                    style="display:none">
                    @foreach ($categories as $category)
                        <a href="/shop/filter?q={{$category->id}}"
                            class="block px-3 py-2 hover:bg-gray-300">{{$category->name}}</a>
                    @endforeach
                </div>
            </div>

            <form method="GET" action="/shop/search" class="bg-gray-200 p-3 flex space-x-2">
                <img height="40px" src="{{Vite::asset('resources/images/icons/povecalo.svg') }}" alt="">
                <input class="bg-gray-200 w-full ring-0 placeholder:text-gray-700 border-0 focus:ring-0" type="text"
                    name="q" placeholder="Pretraži artikle...">
            </form>
        </div>

        <!-- <h3 class="mt-10">Prikazano <strong>25</strong> od <strong>100</strong> rezultata..</h3> -->

        <!-- Card grid -->
        <div class="mt-10 grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-8 my-5">
            @foreach ($products as $product)
                <x-product-card :$product />
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="my-10">
            {{ $products->links() }}
        </div>


    </div>
</x-layout>