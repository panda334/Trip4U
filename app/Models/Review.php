<?php

namespace App\Models;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'trip_id'];

    public function user()
    {
        return $this->belongsTo(User::class);   
    }


    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
