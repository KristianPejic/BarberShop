<x-app-layout>
    <div class="container mx-auto py-10">
        <h1 class="text-2xl font-bold mb-5">Your Order</h1>
    
        <!-- Flexbox layout: row on larger screens, column on smaller screens -->
        <div class="flex flex-col md:flex-row md:space-x-4">
            <!-- Order Summary on the Left -->
            <div class="w-full md:w-1/2 space-y-4" id="cart-container">
                @if(!empty($cart))
                    <!-- Initialize total price -->
                    @php $totalPrice = 0; @endphp
    
                    <!-- Loop through the products in the cart -->
                    @foreach($cart as $id => $details)
                        <div class="flex items-center justify-between p-4 bg-gray-200 rounded-lg shadow-lg">
                            
                            <!-- Product Image -->
                            <div class="w-24 h-24 flex-shrink-0">
                                <img src="{{ asset($details['photo']) }}" alt="{{ $details['name'] }}" class="object-cover w-full h-full rounded-lg">
                            </div>
    
                            <!-- Product Info -->
                            <div class="flex-grow px-4">
                                <h2 class="text-lg font-semibold">{{ $details['name'] }}</h2>
    
                                <!-- Quantity with Increment and Decrement -->
                                <div class="flex items-center mt-2 space-x-2">
                                    <button onclick="updateQuantity({{ $id }}, -1)" class="px-3 py-1 bg-gray-300 text-black rounded hover:bg-gray-400">-</button>
                                    <span id="quantity-{{ $id }}" class="text-lg font-bold">1</span>
                                    <button onclick="updateQuantity({{ $id }}, 1)" class="px-3 py-1 bg-gray-300 text-black rounded hover:bg-gray-400">+</button>
                                </div>
                            </div>
    
                            <!-- Product Price -->
                            <div class="flex flex-col items-end">
                                <span id="price-{{ $id }}" class="text-lg font-semibold">{{ number_format((float) $details['price'], 2) }} KM</span>
                                <span id="total-{{ $id }}" class="text-sm text-gray-500">Total: {{ number_format((float) $details['price'], 2) }} KM</span>
                            </div>
                        </div>
    
                        @php $totalPrice += $details['price']; @endphp
                    @endforeach
    
                    <!-- Total Price Section -->
                    <div class="flex justify-end mt-4">
                        <h3 class="text-xl font-bold">Total: <span id="grand-total">{{ number_format($totalPrice, 2) }}</span> KM</h3>
                    </div>
                @else
                    <p>Your cart is empty.</p>
                @endif
            </div>
    
            <!-- User Information Form on the Right (Only visible if the cart is not empty) -->
            @if(!empty($cart))
            <div class="w-full md:w-1/2 bg-gray-100 p-6 rounded-lg shadow-lg mt-6 md:mt-0">
                <h2 class="text-xl font-bold mb-4">Delivery Information</h2>
                <form action="{{ route('place_order') }}" method="POST" id="order-form">
                    @csrf
                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                    </div>
                
                    <!-- Surname -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Surname</label>
                        <input type="text" name="surname" id="surname" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                    </div>
                
                    <!-- Address -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" id="address" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                    </div>
                
                    <!-- City -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="city" id="city" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                    </div>
                
                    <!-- Postal Code -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                    </div>
                
                    <!-- Country -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Country</label>
                        <select name="country" id="country" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                            <option value="">Select a Country</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Montenegro">Montenegro</option>
                        </select>
                    </div>
                
                    <!-- Submit Button -->
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                        Plati
                    </button>
                </form>
                
            </div>
            @endif
        </div>
    </div>
    
    <!-- Success Popup Modal -->
    <div id="order-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-bold">Narudžba uspješno naručena!</h3>
            <p class="mt-2 text-gray-600">Hvala na narudžbi! Vaša narudžba je uspješno zaprimljena.</p>
            <button onclick="closePopup()" class="mt-4 bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                Zatvori
            </button>
        </div>
    </div>
    
    <script>
    function updateQuantity(productId, change) {
        let quantityElement = document.getElementById('quantity-' + productId);
        let priceElement = document.getElementById('price-' + productId);
        let totalElement = document.getElementById('total-' + productId);
        let grandTotalElement = document.getElementById('grand-total');
        let productElement = document.getElementById('product-' + productId);

        let currentQuantity = parseInt(quantityElement.innerText);
        let pricePerItem = parseFloat(priceElement.innerText);

        let newQuantity = currentQuantity + change;

        // Remove product if the quantity goes below 1
        if (newQuantity < 1) {
            // Remove the entire product card (find the correct parent container)
            productElement
            updateGrandTotal();
            checkCartStatus(); // Check if the cart is empty after product removal
            return;
        }

        // Update the quantity and the total price for that item
        quantityElement.innerText = newQuantity;
        let newTotal = pricePerItem * newQuantity;
        totalElement.innerText = 'Total: ' + newTotal.toFixed(2) + ' KM';

        updateGrandTotal();
    }

    function updateGrandTotal() {
        let allTotalElements = document.querySelectorAll('[id^="total-"]');
        let newGrandTotal = 0;

        allTotalElements.forEach(function (element) {
            let itemTotal = parseFloat(element.innerText.replace('Total: ', '').replace(' KM', ''));
            newGrandTotal += itemTotal;
        });

        let grandTotalElement = document.getElementById('grand-total');
        grandTotalElement.innerText = newGrandTotal.toFixed(2);

        checkCartStatus();
    }

    function checkCartStatus() {
        const cartContainer = document.getElementById('cart-container');
        const submitButton = document.getElementById('submit-button');

        // Check if the cart is empty
        if (cartContainer.children.length === 0) {
            cartContainer.innerHTML = "<p>Your cart is empty.</p>";
            submitButton.disabled = true; // Disable order button when cart is empty
            document.getElementById('order-form').style.display = 'none'; // Hide form
        } else {
            document.getElementById('order-form').style.display = 'block'; // Show form
        }
    }

    function placeOrder() {
        // Show success popup
        document.getElementById('order-popup').classList.remove('hidden');

        // Clear the cart items from the DOM
        document.getElementById('cart-container').innerHTML = "<p>Your cart is empty.</p>";

        // Clear the form fields
        document.getElementById('order-form').reset();

        // Hide the form
        document.getElementById('order-form').style.display = 'none';

        // Optionally: Clear cart data on the server-side (via AJAX or other methods)
        clearCart();
    }

    function clearCart() {
        fetch('/clear-cart', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Cart cleared successfully');
        })
        .catch(error => console.error('Error:', error));
    }

    function closePopup() {
        document.getElementById('order-popup').classList.add('hidden');
    }
</script>
</x-app-layout>