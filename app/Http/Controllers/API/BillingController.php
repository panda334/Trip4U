<?php

namespace App\Http\Controllers\API;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\BillingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\BillingRequest;

class BillingController extends Controller
{
    public function addBillingDetail(BillingService $billingService , Booking $booking , BillingRequest $request)
    {
        $booking = Booking::find($booking->id);
        if(!$booking){
            return response()->json(['message' => 'no booking for this trip']);
        }
        $data = $request->validated();
        $data['booking_id'] = $booking->id; // Add booking_id to data
        $billing = $billingService->addBillingDetails($data);
        return response()->json($billing);

    }
}
