<?php

namespace App\Http\Controllers\API;

use App\Models\Booking;
use App\Models\Travelers;
use Illuminate\Http\Request;
use App\Services\TravelersService;
use App\Http\Controllers\Controller;
use App\Http\Requests\TravelersRequest;

class TravelersController extends Controller
{
    public function addTravelers(TravelersRequest $travelersRequest, Booking $booking, TravelersService $travelersService)
    {
        $booking = Booking::find($booking->id);
        $travelersData = $travelersRequest->validated();
        $createdTravelers = [];
        foreach ($travelersData as $travelerData) {
            $traveler = $travelersService->addTravelers($travelerData);
            $createdTravelers = $traveler;
            $booking->travelers()->attach($traveler->id);
        }
        return response()->json($createdTravelers);
    }

    public function travelersInfo(Booking $booking)
    {
      // make api for get all travelers information 
    }
}
