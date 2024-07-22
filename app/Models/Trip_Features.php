<?php

namespace App\Models;

use App\Models\Trip;
use App\Models\Features;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip_Features extends Model
{
    use HasFactory;

    public function features()
    {
        return $this->belongsTo(Features::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
