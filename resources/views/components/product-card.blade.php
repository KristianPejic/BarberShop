@props(['product'])

<div class="text-black text-center">
    <a href="#">
        <div
            class="border border-gray-300 h-[300px] md:h-[370px] flex flex-col justify-center items-center p-4 hover:border-2 hover:border-orange-500 transition-colors duration-300 group">
            <img class="w-[110px] md:w-[160px]" src="{{Vite::asset('resources/images/product.png') }}" alt="logo">
            <h4 class="mt-5 font-medium text-sm md:text-lg leading-tight">{{$product->name}}</h4>
            <h3 class="font-black text-orange-500 text-xl mt-2">
                {{$product->price}} KM
            </h3>
            <button
                class="bg-gray-200 text-black text-xs md:text-sm w-full mt-5 py-3 hover:bg-black hover:text-white transition-all duration-500">
                Dodaj proizvod
            </button>
        </div>
    </a>
</div>