<x-app-layout>

    @section('content')
    <div class="container mx-auto bg-white p-5 m-10">
        <h1 class="text-2xl font-bold mb-4">Your Reservations</h1>

        @if ($reservations->isEmpty())
            <p>You have no reservations.</p>
        @else
            <div id="reservation-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($reservations as $reservation)
                    <div id="reservation-{{ $reservation->id }}" class="reservation-card border p-4 rounded-lg shadow">
                        <h2 class="font-semibold text-lg mb-2">Service: {{ $reservation->service }}</h2>
                        <p class="text-black-700">User: {{$reservation->user->name}}</p>
                        <p class="text-gray-700">Barber: {{ $reservation->barber }}</p>
                        <p class="text-gray-700">Date: {{ $reservation->date }}</p>
                        <p class="text-gray-700">Time: {{ $reservation->time }}</p>
                        <button onclick="deleteReservation({{ $reservation->id }})"
                            class="bg-orange-500 text-white px-4 py-2 mt-4 rounded hover:bg-orange-600">Izbriši</button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        function deleteReservation(reservationId) {
            if (confirm('Are you sure you want to delete this reservation?')) {
                fetch(`/reservations/user/${reservationId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`reservation-${reservationId}`).remove();
                        } else {
                            alert('Failed to delete the reservation.');
                        }
                    });
            }
        }
    </script>
</x-app-layout>