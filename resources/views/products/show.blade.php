<x-layout>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-20 justify-center text-black">

        <div class="grid xl:grid-cols-2 justify-center gap-5 sm:gap-10">
            <div class="border rounded-xl grid justify-center items-center p-2">
                <img width="600px" src="{{asset($product->photo)}}" alt="">
            </div>

            <div>
                <div class="flex flex-col space-y-5">
                    <h1 class="text-5xl font-light">{{$product->name}}</h1>

                    @if ($product->discount_price == null)
                        <h3 class="font-black text-orange-500 text-3xl mt-2">
                            {{$product->price}} KM
                        </h3>
                    @else
                        <div class="flex mt-2 space-x-3 items-end">
                            <h3 class="text-2xl font-bold text-gray-400 line-through">
                                {{$product->price}} KM
                            </h3>
                            <h3 class="text-3xl font-black text-orange-500 ">
                                {{$product->discount_price}} KM
                            </h3>
                        </div>
                    @endif


                    <div class="flex items-center space-x-6">
                        <div class="flex items-center my-auto space-x-2">
                            <span>Dostupnost: </span>
                            @if ($product->availability == 1)
                                <span class="font-black text-green-500">DA</span>
                            @else
                                <span class="font-black text-red-500">NE</span>
                            @endif
                        </div>
                        <button
                            class="bg-gray-200 text-black text-xs md:text-sm w-full py-3 hover:bg-black hover:text-white transition-all duration-500">
                            Dodaj u košaricu
                        </button>
                    </div>

                    <hr>

                    <a class="text-sm" href="/shop/filter?q={{$product->category->id}}">
                        Kategorija:
                        <span class="font-extrabold hover:text-orange-500 transition-colors duration-300">
                            {{$product->category->name}}
                        </span>
                    </a>

                    <p class="whitespace-pre-wrap font-light">{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>