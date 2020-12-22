<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorAddress extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = "vendor_addresses";
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
                if ($address->customer != null) {
                    $address->customer->addresses()->update([
                        'default' => false
                    ]);
                }
            }
        });
    }

    public function setDefaultAttribute($value)
    {
        $this->attributes['default'] = ($value === 'true' || $value ? true : false);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
