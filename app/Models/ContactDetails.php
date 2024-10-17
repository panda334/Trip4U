<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 
        'last_name' ,
        'email' , 
        'phone_number' ,
        'address' , 
        'booking_id'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
