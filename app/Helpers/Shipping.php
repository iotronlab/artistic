<?php

namespace App\Helpers;

use App\Models\Customer\Address;

class Shipping
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    // public function checkService($address_id)
    // {
    //     $address = Address::find($address_id)->with('country');
    //     if ($address->country->id == 99) {
    //         $this->checkLocalService($address);
    //     } else
    //         $this->checkInternationalService($address);
    // }

    public function checkLocalService($address)
    {
        # code...
    }

    public function checkInternationalService($address)
    {
        # code...
    }
    public function createOrder()
    {
    }
}
