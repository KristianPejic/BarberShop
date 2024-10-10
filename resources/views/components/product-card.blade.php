@props(['product'])

<div class="text-black text-center">
    <div class="relative border border-gray-300 h-full flex flex-col justify-center items-center p-4 hover:border-2 hover:border-orange-500 transition-colors duration-300 group">
        <p class="text-white absolute left-3 top-3 text-xs bg-orange-500 px-3 py-2 font-bold">
            {{$product->category->name}}
        </p>

        <img class="w-[110px] md:w-[160px]" src="{{asset($product->photo)}}" alt="photo">
        <h4 class="mt-5 font-medium text-sm md:text-lg leading-tight">{{$product->name}}</h4>

        @if ($product->discount_price == null)
            <h3 class="font-black text-orange-500 text-xl mt-2">{{$product->price}} KM</h3>
        @else
            <div class="sm:flex items-center mt-2 sm:space-x-3 justify-center">
                <h3 class="text-base sm:text-xl font-bold text-gray-400 line-through">{{$product->price}} KM</h3>
                <h3 class="font-black text-orange-500 text-xl">{{$product->discount_price}} KM</h3>
            </div>
        @endif

        <!-- Added a unique id to the button and data-id attribute -->
        <button class="bg-gray-200 text-black text-xs md:text-sm w-full mt-5 py-3 hover:bg-black hover:text-white transition-all duration-500"
            id="add-to-cart-{{ $product->id }}" data-id="{{ $product->id }}">
            Dodaj u košaricu
        </button>
    </div>
</div>

<script>
    document.querySelectorAll('[id^="add-to-cart-"]').forEach(function(button) {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            addToCart(productId);
        });
    });

    function addToCart(id) {
        fetch(`/cart/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ quantity: 1 })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const flashMessage = document.createElement('div');
                flashMessage.classList.add('fixed', 'bottom-4', 'left-4', 'bg-orange-500', 'text-white', 'py-2', 'px-4', 'rounded', 'shadow-lg');
                flashMessage.innerHTML = data.success;
                document.body.appendChild(flashMessage);

                setTimeout(() => { flashMessage.remove(); }, 1500);

                // Optionally reload the cart dropdown dynamically
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
