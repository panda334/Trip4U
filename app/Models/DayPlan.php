<?php

namespace App\Models;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DayPlan extends Model
{
    use HasFactory;

    protected $fillable = ['day_plan'];

    public function trips()
    {
        return $this->belongsToMany(Trip::class ,'trip_day_plans');
    }
}
