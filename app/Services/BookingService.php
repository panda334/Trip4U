<?php

namespace App\Services;

use App\Services;
use App\Models\Booking;

class BookingService
{
    public function createBooking($data, $trip, $user)
    {
        $book = Booking::create(array_merge($data, [
            'user_id' => $user,
            'trip_id' => $trip->id
        ]));
        return $book;
    }


    public function bookingInfo(Booking $booking)
    {
        $booking = Booking::findOrFail($booking->id); //Take the booking ID to socific the current booking
        $trip = $booking->trip;   //Chose the trip we booking it
        $destination = $trip->destination;   //Bring the name of the destination for this trip 
        $country = $destination->country->name;   //define the country name
        $destination = $destination->name;   // define the destination name
        $firstDateTrip = $booking->start_date;   //bring the start date for the trip 
        $endDateTrip = $booking->end_date;   //bring the end date
        $duration = $trip->duration;    //breing the duration
        $adult = $booking->adult;   //bring count of the adults
        $children = $booking->children;   // bring count of the childrens 
        $infant = $booking->infant;   // ......
        $price = ($trip->adult_price * $adult) + ($trip->children_price * $children) + ($trip->infant_price * $infant); // Count the price dpends on how many adults , childrens . infants in this trip
        return response()->json([
            'Country' => $country,
            'Destination' => $destination,
            'Start Date' => $firstDateTrip,
            'End Date' => $endDateTrip,
            'Duration' => $duration,
            'Adults' => $adult,
            'Childrens' => $children,
            'Infants' => $infant,
            'Total Price' => $price
        ]);
    }
}
