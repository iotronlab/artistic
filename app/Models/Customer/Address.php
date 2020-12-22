<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer\Customer;

class Address extends Model
{
    use HasFactory;
    protected $table = "addresses";
    protected $fillable = [
        'name',
        'address_1',
        'address_2',
        'landmark',
        'type',
        'contact',
        'city',
        'state',
        'country',
        'postal_code',
        'default'
    ];

    public static function boot()
    {

        parent::boot();
        //For update & create functions
        static::saving(function ($address) {

            if ($address->default) {
                $address->customer->addresses()->update([

                    'default' => false
                ]);
            }
        });
    }

    public function setDefaultAttribute($value)
    {
        $this->attributes['default'] = ($value === 'true' || $value ? true : false);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
