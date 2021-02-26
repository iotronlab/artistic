<?php

namespace App\Policies;

use App\Models\Customer\Address;
use App\Models\Customer\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function show(Customer $customer, Address $address)
    {
        return $customer->id == $address->customer_id;
    }
}
