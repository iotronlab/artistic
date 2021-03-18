<?php

namespace App\Models\Order;

use App\Models\Locale\Country;
use App\Models\Traits\HasPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',
        'courier_partner',
        'type',
        'price'
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_shipping_method');
    }
}
