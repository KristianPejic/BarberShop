<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Show reservation page with available time slots
    public function index(Request $request)
    {
        // Fetch the selected date or default to today's date
        $selectedDate = $request->input('date', now()->format('Y-m-d'));

        // Fetch existing reservations for the selected date
        $reservations = Reservation::where('date', $selectedDate)
                                   ->pluck('time') // Only get the 'time' field
                                   ->toArray();

        // Generate time slots in 30-minute intervals from 09:00 to 17:00
        $start = new \DateTime('09:00');
        $end = new \DateTime('17:00');
        $interval = new \DateInterval('PT30M'); // 30 minutes interval
        $times = new \DatePeriod($start, $interval, $end);

        // Pass the times and reservations to the view
        return view('reservation', compact('times', 'reservations', 'selectedDate'));
    }

    // Store a new reservation
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'service' => 'required|string',
            'barber' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        // Define available times in 30-minute intervals
        $availableTimes = [];
        $start = new \DateTime('09:00');
        $end = new \DateTime('17:00');
        $interval = new \DateInterval('PT30M');
        $times = new \DatePeriod($start, $interval, $end);

        foreach ($times as $time) {
            $availableTimes[] = $time->format('H:i');
        }

        // Check if the selected time is valid
        if (!in_array($request->time, $availableTimes)) {
            return response()->json(['message' => 'The selected time is not valid. Please choose a valid time slot.'], 422);
        }

        // Check if the selected time is already booked
        $existingReservation = Reservation::where('date', $request->date)
                                          ->where('time', $request->time)
                                          ->first();

        if ($existingReservation) {
            return response()->json(['message' => 'The selected time slot is already booked. Please choose another time.'], 422);
        }

        // Save the reservation
        $validatedData['user_id'] = Auth::id(); // Set the user_id from the authenticated user
        Reservation::create($validatedData);

        return response()->json(['message' => 'Reservation successfully created!'], 201);
    }

    // Show user-specific reservations
    public function userReservations()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        // Admin sees all reservations, while regular users see their own
        if ($user->admin == 1) {
            $reservations = Reservation::all();
        } else {
            $reservations = Reservation::where('user_id', $user->id)->get();
        }

        return view('user_reservations', compact('reservations'));
    }

    // Delete a reservation
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json(['success' => true]);
    }
}
