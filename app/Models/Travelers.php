<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travelers extends Model
{
    use HasFactory;


    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }
}
