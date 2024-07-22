<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function createBooking(BookingRequest $bookingRequest , Trip $trip)
    {
        $trip = Trip::findOrFail($trip);
        $data = $bookingRequest->validated();
        $book = Booking::create([
            $data ,
            'trip_id' => $trip,
            'user_id' => Auth::user(), 
        ]);
        return response()->json($book);
    }
}
