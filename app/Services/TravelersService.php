<?php

namespace App\Services;

use App\Models\Travelers;
use App\Services;

class TravelersService
{
    public function addTravelers($travelerData)
    {
        $travelers = Travelers::create($travelerData);
        return $travelers;
    }
}
