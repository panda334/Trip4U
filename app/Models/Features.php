<?php

namespace App\Models;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Features extends Model
{
    use HasFactory;

    protected $fillable = ['features'];

    public function trips()
    {
        return $this->belongsToMany(Trip::class , 'trip__features');
    }
}
