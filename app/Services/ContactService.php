<?php
namespace App\Services;

use App\Models\ContactDetails;
use App\Services;

class ContactService
{
    public function addContactDetails($data)
    {
        $contact = ContactDetails::create($data);
        return $contact;
    }
}