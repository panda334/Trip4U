<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::with('features' , 'day_plans' , 'advantages' ,  'destination')->get();
        return  TripResource::collection($trips); 
    }


   
     // There is issue with findOrFail
    public function show(Trip $trip)
    {
     $trip = Trip::with('day_plans' , 'features' , 'advantages' , 'destination')->find($trip);
     return response()->json([$trip]);
    } 

  public function getImagesForTrip($id)
  {
    $trip = Trip::findOrFail($id)->getMedia('avatars');
    return response()->json($trip);
  }
}
