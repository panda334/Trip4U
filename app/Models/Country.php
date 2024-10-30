<?php

namespace App\Models;

use App\Models\Destination;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name'];
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
    public function getAvatarUrlAttribute()
    {
        return $this->getFirstMediaUrl('country_profile');
    }
    
}
