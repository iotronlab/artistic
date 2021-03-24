<?php

namespace App\Models\Product;

use App\Models\Vendor\VendorAddress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public $table = 'stocks';
    protected $fillable = [
        'quantity',
        'product_id',
        'vendor_address_id'
    ];
    /**
     * Get the product that owns the product stock.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function address()
    {
        return $this->belongsTo(VendorAddress::class);
    }
}
