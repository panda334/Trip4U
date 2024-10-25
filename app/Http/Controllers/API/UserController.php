<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userBookings(Booking $booking)
    {
        $user = Auth::user();
        $bookings = Booking::with('trip:id,name') // Eager load trips with specific columns
        ->where('user_id', $user->id)
        ->get();

    // Map the bookings to include trip names
    $bookingsWithTripNames = $bookings->map(function ($booking) {
        return [
            'booking_id' => $booking->id,
            'trip_name' => $booking->trip->name, // Get the trip name
            'created_at' => $booking->created_at, // Include booking date if needed
        ];
    });
        return response()->json($bookingsWithTripNames);
    }
}
