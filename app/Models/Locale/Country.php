<?php

namespace App\Models\Locale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'iso_code_2',
        'iso_code_3',
        'isd_code',
        'address_format',
        'postcode_required',
        'status'
    ];
}
