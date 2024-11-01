<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
  public function index()
  {
    $trips = Trip::with('features', 'day_plans', 'advantages',  'destination')->get();
    return  TripResource::collection($trips);
  }



  // There is issue with findOrFail
  public function show(Trip $trip)
  {
    $trip = Trip::with('day_plans', 'features', 'advantages', 'destination')->find($trip);
    return TripResource::collection($trip);
  }

  public function getImagesForTrip($id)
  {
    $trip = Trip::findOrFail($id)->getMedia('avatars');
    return response()->json($trip);
  }
  public function getProfileImageForTrip($id)
  {
    try{
    $trip = Trip::findOrFail($id)->getMedia('trip_profile');
    return response()->json($trip);
    }
    catch(\Exception $e){
      return response()->json(['error' => 'No Profile image for this trip.'], 500);
    }
  }

  public function search(Request $request)
  {
    $query = Trip::query();

    // Check if a search term is provided
    if ($request->has('search') && !empty($request->search)) {
      $searchTerm = $request->search;

      // Search by destination or name (or any other relevant fields)
      $query->where(function ($q) use ($searchTerm) {
        $q->where('name', 'LIKE', '%' . $searchTerm . '%')
          ->orWhere('type', 'LIKE', '%' . $searchTerm . '%')
          ->orWhere('date', 'LIKE', '%' . $searchTerm . '%')
          ->orWhere('duration', 'LIKE', '%' . $searchTerm . '%')
          ->orWhere('avibality', 'LIKE', '%' . $searchTerm . '%');
      });
    }

    // Execute the query and get results
    $trips = $query->get();

    // Return the results as JSON
    return TripResource::collection($trips);
  }



  public function filter(Request $request)
  {
    $query = Trip::query();

    // Filter by destination
    if ($request->has('destination') && !empty($request->destination)) {
      $query->where('destination', 'LIKE', '%' . $request->destination . '%');
    }

    // Duration mapping with ranges
    $durationRanges = [
      '1-5 Days' => [1, 5],
      '6-10 Days' => [6, 10],
      '1 Week - 2 Weeks' => [7, 14],
      '2 weeks - more' => [14 , 100],
    ];

    // Filter by duration
    if ($request->has('duration') && !empty($request->duration)) {
      $duration = $request->duration;
      if (isset($durationRanges[$duration])) {
        $range = $durationRanges[$duration];
        $query->whereBetween('duration', [$range[0], $range[1]]);
      }
    }

    // Filter by price range
    if ($request->has('min_price') && !empty($request->min_price)) {
      $query->where('price', '>=', $request->min_price);
    }
    if ($request->has('max_price') && !empty($request->max_price)) {
      $query->where('price', '<=', $request->max_price);
    }

    // Filter by trip type
    if ($request->has('type') && !empty($request->type)) {
      $query->where('type', '=', $request->type);
    }

    if ($request->has('first_date') && !empty($request->first_date)) {
      $query->where('first_date', '=', $request->first_date);
    }

    // Execute the query and get results
    $trips = $query->get();

    return TripResource::collection($trips);
  }


  public function showTripsForOneCountry($countryId)
  {
      // Find the country by ID
      $country = Country::with('destinations.trips')->find($countryId);

      // Check if country exists
      if (!$country) {
          return response()->json(['message' => 'Country not found'], 404);
      }

      // Collect all trips from the destinations
      $trips = $country->destinations->flatMap(function($destination) {
          return $destination->trips;
      })->unique('id'); // Remove duplicates

      return TripResource::collection($trips);
  }
}
