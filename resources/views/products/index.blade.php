<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="my-5 grid grid-cols-2 lg:grid-cols-4 gap-4">
            <form method="GET" action="/product/search" class="col-span-2 bg-gray-200 p-3 flex space-x-2">
                <img height="40px" src="{{Vite::asset('resources/images/icons/povecalo.svg') }}" alt="">
                <input class="bg-gray-200 w-full ring-0 placeholder:text-gray-700 border-0 focus:ring-0" type="text"
                    name="q" placeholder="Pretraži artikle...">
            </form>

            <div x-data="{show: false}" @click.away="show = false" class="">
                <button @click="show = ! show" class="bg-gray-200 p-3 flex space-x-2 justify-center items-center hover:bg-gray-300
                    transition-colors w-full duration-300">
                    <img height="40px" src="{{Vite::asset('resources/images/icons/filter-icon.svg') }}" alt="">
                    <span>Filtriraj</span>
                </button>

                <div x-show="show"
                    class="mt-3 justify-center z-50 bg-gray-200 absolute w-[90%] lg:w-[39.5%] text-center"
                    style="display:none">
                    @foreach ($categories as $category)
                        <a href="/product/filter?q={{$category->id}}"
                            class="block px-3 py-2 hover:bg-gray-300">{{$category->name}}</a>
                    @endforeach
                </div>
            </div>

            <a href="/product/create"
                class="bg-orange-500 text-white p-3 space-x-2 justify-center items-center hover:bg-orange-600 transition-colors duration-300 flex">
                Dodaj proizvode
            </a>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                                <thead class="bg-gray-50 border-b border-neutral-200 font-medium dark:border-white/10">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">ID</th>
                                        <th scope="col" class="px-6 py-4">Slika</th>
                                        <th scope="col" class="px-6 py-4">Naziv</th>
                                        <th scope="col" class="px-6 py-4">Kategorija</th>
                                        <th scope="col" class="px-6 py-4">Cijena</th>
                                        <th scope="col" class="px-6 py-4">Snižena cijena</th>
                                        <th scope="col" class="px-6 py-4">Dostupnost</th>
                                        <th scope="col" class="px-6 py-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr
                                            class="border-b border-neutral-200 transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-white/10 dark:hover:bg-neutral-600">

                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{$product->id}}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 justify-center">
                                                <a href="/products/{{$product->id}}" target="_blank">
                                                    <img width="60px" src="{{asset($product->photo)}}"
                                                        alt="{{$product->name}}">
                                                </a>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$product->name}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$product->category->name}}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{$product->price}} KM</td>
                                            @if ($product->discount_price == null)
                                                <td class="whitespace-nowrap px-6 py-4"> ---
                                                </td>
                                            @else
                                                <td class="whitespace-nowrap px-6 py-4">{{$product->discount_price}} KM</td>

                                            @endif

                                            @if ($product->availability == 0)
                                                <td class="text-red-500 font-bold whitespace-nowrap px-6 py-4"> NE
                                                </td>
                                            @else
                                                <td class="whitespace-nowrap px-6 py-4"> DA
                                                </td>
                                            @endif

                                            <td class="flex md:pt-7 items-center whitespace-nowrap px-6 py-4 space-x-1">
                                                <a href="/products/{{$product->id}}" target="_blank"
                                                    class="text-xs font-bold bg-gray-200 hover:bg-gray-300 text-black py-2 px-3">View
                                                </a>
                                                <a href="/product/{{$product->id}}/edit" target="_blank"
                                                    class="text-xs font-bold bg-orange-500 hover:bg-orange-600 text-white py-2 px-3">Edit
                                                </a>
                                                <form action="/product/{{$product->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="text-xs font-bold bg-black hover:bg-gray-800 text-white py-2 px-3">Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>


                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-5">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <x-flash />

</x-app-layout>