<?php

namespace App\Models\Traits;



use App\Helpers\Money;


trait HasPrice
{
    public function getPriceAttribute($value)
    {
        return new Money($value);
    }
    public function getSpecialPriceAttribute($value)
    {
        return new Money($value);
    }

    public function getFormattedPriceAttribute()
    {
        return  $this->price->formatted();
    }
    public function getRawPriceAttribute()
    {
        return  $this->price->amount();
    }
    public function getFormattedSpecialPriceAttribute()
    {
        return  $this->special_price->formatted();
    }
    public function getRawSpecialPriceAttribute()
    {
        return  $this->special_price->amount();
    }
}
