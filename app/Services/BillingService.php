<?php
namespace App\Services;

use App\Models\BillingDetails;
use App\Services;

class BillingService
{
    public function addBillingDetails($data)
    {
        $billing = BillingDetails::create($data);
        return $billing;
    }
}