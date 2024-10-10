<x-app-layout>
    <h1 class="text-2xl font-bold mb-6 px-4">All Orders</h1>

    @if($orders->count() > 0)
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-2 px-4 border-b">Order ID</th>
                    <th class="py-2 px-4 border-b">Customer Name</th>
                    <th class="py-2 px-4 border-b">City</th>
                    <th class="py-2 px-4 border-b">Total Amount</th>
                    <th class="py-2 px-4 border-b">Date</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $order->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $order->customer_name }}</td>
                        <td class="py-2 px-4 border-b">{{ $order->city }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format($order->total_amount, 2) }} KM</td>
                        <td class="py-2 px-4 border-b">{{ $order->created_at }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="text-sm font-semibold {{ $order->status == 'Accepted' ? 'text-green-600' : ($order->status == 'Denied' ? 'text-red-600' : 'text-yellow-600') }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('order.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="status" value="Accepted" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Accept</button>
                                <button type="submit" name="status" value="Denied" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 ml-2">Deny</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No orders available.</p>
    @endif
</x-app-layout>
