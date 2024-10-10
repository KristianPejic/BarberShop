<x-app-layout>

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-semibold mb-6">Your Cart</h2>

    @if (session('cart'))
        <div class="grid gap-6">
            @foreach (session('cart') as $id => $details)
                <div class="flex items-center justify-between p-4 border">
                    <div class="flex items-center">
                        <img src="{{ $details['photo'] }}" class="w-16 h-16 mr-4">
                        <div>
                            <h4>{{ $details['name'] }}</h4>
                            <p>{{ $details['price'] }} KM</p>
                        </div>
                    </div>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500">Remove</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-6 text-right">
            <h4 class="text-xl font-semibold">Total: {{ $totalPrice }} KM</h4>
            <a href="/checkout" class="bg-orange-500 text-white px-6 py-3 rounded">Proceed to Checkout</a>
        </div>
    @else
        <p>Your cart is empty</p>
    @endif
</div>
@endsection
</x-app-layout>
