<?php

namespace App\Http\Controllers\API;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\ContactDetails;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;

class ContactController extends Controller
{
    public function addContactDetail(ContactService $contactDetails , Booking $booking , ContactRequest $request)
    {
        $booking = Booking::find($booking->id);
        if(!$booking){
            return response()->json(['message' => 'no booking for this trip']);
        }
        $data = $request->validated();
        $data['booking_id'] = $booking->id; // Add booking_id to data
        $contact = $contactDetails->addContactDetails($data);
        return response()->json($contact);

    }
}
