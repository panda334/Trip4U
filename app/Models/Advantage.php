<?php

namespace App\Models;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advantage extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_include' , 
        'price_uninclude'
    ];


    public function trips()
    {
        return $this->belongsToMany(Trip::class , 'advantage_trips');
    }
}
