<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travelers extends Model
{
    use HasFactory;

    protected $fillable = ['first_name' , 'last_name' , 'age' , 'phone_number'];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }
}
