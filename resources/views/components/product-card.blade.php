@props(['product'])

<div class="text-black text-center">
    <a href="/products/{{$product->id}}">
        <div
            class="relative border border-gray-300 h-full flex flex-col justify-center items-center p-4 hover:border-2 hover:border-orange-500 transition-colors duration-300 group">

            <p class="text-white absolute left-3 top-3 text-xs bg-orange-500 px-3 py-2 font-bold">
                {{$product->category->name}}
            </p>

            <img class="w-[110px] md:w-[160px]" src="{{asset($product->photo)}}" alt="photo">
            <h4 class="mt-5 font-medium text-sm md:text-lg leading-tight">{{$product->name}}</h4>
            @if ($product->discount_price == null)
                <h3 class="font-black text-orange-500 text-xl mt-2">
                    {{$product->price}} KM
                </h3>
            @else
                <div class="sm:flex items-center mt-2 sm:space-x-3 justify-center">
                    <h3 class="text-base sm:text-xl font-bold text-gray-400 line-through">
                        {{$product->price}} KM
                    </h3>
                    <h3 class="font-black text-orange-500 text-xl">
                        {{$product->discount_price}} KM
                    </h3>
                </div>
            @endif

            <button
                class="bg-gray-200 text-black text-xs md:text-sm w-full mt-5 py-3 hover:bg-black hover:text-white transition-all duration-500">
                Dodaj u košaricu
            </button>
        </div>
    </a>
</div>