<?php

namespace App\Models\Order;

use App\Models\Customer\Address;
use App\Models\Customer\Customer;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PENDING = 'pending';
    const PROCESSING = 'processing';
    const PAYMENT_FAILED = 'payment_failed';
    const COMPLETED = 'completed';

    protected $fillable = [
        'status',
        'address_id',
        'shipping_method_id',
        'customer_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->status = self::PENDING;
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders')->withPivot(['quantity'])->withTimestamps();
    }
}
