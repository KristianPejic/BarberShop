<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Display the cart
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = array_sum(array_map(function($item) {
            return (float) $item['price'];
        }, $cart));
        
        return view('cart.index', compact('cart', 'totalPrice'));
    }

    public function addToCart(Request $request, $id)
{
    // Find the product in the database
    $product = Product::findOrFail($id);

    // Retrieve the cart from session, or create an empty array if none exists
    $cart = session()->get('cart', []);

    // Add the product to the cart as a unique item without dealing with quantity
    $cart[$id] = [
        'name' => $product->name,
        'price' => (float) ($product->discount_price ?? $product->price), // Ensure price is numeric
        'photo' => $product->photo,
    ];

    // Store the updated cart back into the session
    session()->put('cart', $cart);

    return response()->json(['success' => 'Proizvod uspješno dodan u košaricu!', 'cart' => $cart]);
}

    

    


    // Remove product from cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => 'Proizvod uspješno uklonjen iz košarice']);
    }
}
