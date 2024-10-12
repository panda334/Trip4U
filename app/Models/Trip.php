<?php

namespace App\Models;

use App\Models\User;
use App\Models\DayPlan;
use App\Models\Features;
use App\Models\Advantage;
use App\Models\Destination;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    
    protected $fillable = [
     'name' , 
     'adult_price' ,
     'children_price',
     'infant_price', 
     'type' , 
     'date' , 
     'first_date',
     'end_date',
     'description',
     'duration',
     'destination_id',
     'avibality'];
     
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function features()
    {
        return $this->belongsToMany(Features::class , 'trip__features');
    }
  

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function advantages()
    {
        return $this->belongsToMany(Advantage::class , 'advantage_trips');
    }

    public function day_plans()
    {
        return $this->belongsToMany(DayPlan::class , 'trip_day_plans');
    }

    public function images()
{
    return $this->getMedia('avatars'); // 'images' is the collection name
}

    public function getDurationAttribute()
    {
        $trip = Trip::findOrFail($this->id);
        $start_date = $trip->first_date;
        $end_date = $trip->end_date;
        $duration = Carbon::parse($start_date)->diffInDays(Carbon::parse($end_date)) + 1;
        $trip->duration = $duration;
        $trip->save();
        return $duration;
    }

    // protected static function booted()
    // {
    //     static::saving(function ($trip) {
    //         if ($trip->start_date && $trip->end_date) {
    //             $trip->duration = Carbon::parse($trip->start_date)->diffInDays(Carbon::parse($trip->end_date)) + 1;
    //         }
    //     });
    // }

}
