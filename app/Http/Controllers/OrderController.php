<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    public function userOrders()
    {
        $cart = session()->get('cart', []);
    
        // Pass the cart data to the view
        return view('orders.user_orders', compact('cart'));
    }

    // Method for admin to view all orders (all products that have been ordered)
    public function adminAllOrders()
{
    // Fetch all orders from the database (or session)
    $orders = Order::all();

    return view('orders.all_orders', compact('orders'));
}

public function placeOrder(Request $request)
{
    // Validate the delivery form input
    $request->validate([
        'name' => 'required|string',
        'surname' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'postal_code' => 'required|string',
        'country' => 'required|string',
    ]);

    // Fetch the cart from the session
    $cart = session()->get('cart', []);
    $totalPrice = 0;

    foreach ($cart as $id => $item) {
        $totalPrice += $item['price'];
    }

    // Save the order and delivery information in the database
    $order = Order::create([
        'customer_name' => $request->input('name') . ' ' . $request->input('surname'),
        'address' => $request->input('address'),
        'city' => $request->input('city'),
        'postal_code' => $request->input('postal_code'),
        'country' => $request->input('country'),
        'total_amount' => $totalPrice,
        'status' => 'Pending',
    ]);

    // Clear the cart after placing the order
    session()->forget('cart');

    return redirect()->back()->with('success', 'Order placed successfully!');
}
public function updateStatus(Request $request, $id)
{
    // Find the order by ID
    $order = Order::findOrFail($id);

    // Update the status
    $order->status = $request->input('status');
    $order->save();

    return redirect()->back();
}
}