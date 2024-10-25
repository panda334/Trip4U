<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TripController;
use App\Http\Controllers\API\BillingController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\TravelersController;
use App\Http\Controllers\ContactDetailsController;
use App\Http\Controllers\API\DestinationController;
use App\Http\Controllers\API\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




// Trip Routes
Route::get('/trips', [TripController::class, 'index'])->name('paginateTrips');
Route::get('/trip/{trip}', [TripController::class, 'show'])->name('showOneTrip');
Route::get('/tripImage/{id}', [TripController::class, 'getImagesForTrip'])->name('showOneTrip');
Route::get('showTripsForOneCountry/{id}' , [TripController::class , 'showTripsForOneCountry']);


// Destination Routes
Route::get('/destinationsWithTrips', [DestinationController::class, 'destinationsWithTrips'])->name('destinationsWithTrips');
Route::get('/destinations', [DestinationController::class, 'index'])->name('paginateDestinations');


// Country Routes
Route::get('/countries', [CountryController::class, 'index'])->name('paginateCountries');
Route::get('/countriesWithDestination', [CountryController::class, 'countriesWithDestination'])->name('countriesWithDestination');


Route::post('addBillingDetails/{booking}', [BillingController::class, 'addBillingDetail']);
Route::post('addContactDetails/{booking}', [ContactController::class, 'addContactDetail']);


// Search and Filter trips
Route::get('searchTrips' , [TripController::class , 'search']);
Route::get('filterTrips' , [TripController::class , 'filter']);
// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/bookingTrip/{trip}', [BookingController::class, 'createBooking'])->name('createBooking');
    Route::get('/bookingInfo/{booking}', [BookingController::class, 'bookingInfo']);

    // Travelers Routes
    Route::post('/addTravelers/{booking}', [TravelersController::class, 'addTravelers']);
    Route::get('/travelersInfo/{booking}', [BookingController::class, 'travelersInformationDepandsOnBooking']);
    
    Route::get('userBooking' , [UserController::class , 'userBookings']);

    //Billings and Contact Details
    Route::post('addBillingDetails/{booking}', [BillingController::class, 'addBillingDetail']);
    Route::post('addContactDetails/{booking}', [ContactController::class, 'addContactDetail']);
});
