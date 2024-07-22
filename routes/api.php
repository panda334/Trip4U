<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TripController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\DestinationController;
use App\Http\Controllers\BookingController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




// Trip Routes
Route::get('/trips' , [TripController::class , 'index'])->name('paginateTrips');
Route::get('/trip/{trip}' , [TripController::class , 'show'])->name('showOneTrip');


// Destination Routes
Route::get('/destinationsWithTrips' , [DestinationController::class , 'destinationsWithTrips'])->name('destinationsWithTrips');
Route::get('/destinations' , [DestinationController::class , 'index'])->name('paginateDestinations');


// Country Routes
Route::get('/countries' , [CountryController::class , 'index'])->name('paginateCountries');
Route::get('/countriesWithDestination' , [CountryController::class , 'countriesWithDestination'])->name('countriesWithDestination');



Route::post('/bookingTrip/{trip}' , [BookingController::class , 'createBooking'])->name('createBooking');

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
