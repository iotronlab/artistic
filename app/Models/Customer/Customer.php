<?php

namespace App\Models\Customer;

use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'subscribed_to_newsletter' => 'boolean',
        'status' => 'boolean',
    ];
    public function social()
    {
        return $this->hasMany(CustomerSocial::class, 'customer_id', 'id');
    }

    public function hasSocialLinked($service)
    {
        return (bool) $this->social->where('service', $service)->count();
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function wishlist()
    {
        return $this->belongsToMany(Product::class, 'customer_wishlist')->withTimestamps();;
    }

    public function cart()
    {
        return $this->belongsToMany(Product::class, 'cart_user')
            ->withPivot('quantity', 'courier_id', 'courier_name', 'shipping_rate')->withTimestamps();
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Vendor::class, 'customer_subscription')->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
