<?php

namespace App\Http\Controllers\API;

use App\Models\Trip;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\BookingService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function createBooking(BookingRequest $request, Trip $trip, BookingService $bookingService)
    {
        $trip = Trip::find($trip)->first();
        $user = Auth::user()->id;
        $data = $request->validated();

        //Check if the user booking this trip or not...
        // $existingBooking = Booking::where('user_id', Auth::user()->id)
        //     ->where('trip_id', $trip->id)
        //     ->first();

        // if ($existingBooking) {
        //     return response()->json('you booking this trip before');
        // }

        $book = $bookingService->createBooking($data, $trip, $user);
        return response()->json($book);
    }


    public function bookingInfo(Booking $booking, BookingService $bookingService)
    {
        return $bookingService->bookingInfo($booking);
    }

    public function travelersInformationDepandsOnBooking(Booking $booking)
    {
        $booking = Booking::findOrFail($booking->id);
        $trip = $booking->trip->name;
        $travelers = $booking->travelers;
        return response()->json([$trip, $travelers]);
    }
}
