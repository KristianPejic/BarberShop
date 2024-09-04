<?php

namespace App\Http\Controllers;

use App\Http\Middleware\MustBeAdmin;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'service' => 'required|string',
            'barber' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);
    
        $validatedData['user_id'] = Auth::id(); // Set the user_id from the authenticated user
    
        $reservation = Reservation::create($validatedData);
    
        return response()->json(['message' => 'Reservation successfully created!'], 201);
    }
    
    public function userReservations()
{
    $user = Auth::user(); // Get the authenticated user
    if (!$user) {
        abort(403, 'Unauthorized action.'); // Handle cases where the user is not authenticated
    }

    if ($user->admin == 1) {
        $reservations = Reservation::all();
    }
    else {
    $reservations = Reservation::where('user_id', $user->id)->get(); // Retrieve reservations for the authenticated user
}

    return view('user_reservations', compact('reservations')); // Pass reservations to the view
}
public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json(['success' => true]);
    }

    
}
