<?php

namespace App\Models;

use App\Models\Trip;
use App\Models\User;
use App\Models\Travelers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
     'user_id',
     'trip_id',
     'adult', 
     'children', 
     'infant', 
     'start_date', 
     'end_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function travelers()
    {
        return $this->belongsToMany(Travelers::class);
    }
}
