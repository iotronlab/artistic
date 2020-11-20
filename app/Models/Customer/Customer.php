<?php

namespace App\Models\Customer;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'id', 'name', 'email', 'password',
    ];
    protected $hidden = [
        'password',
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
        return $this->belongsToMany(Product::class, 'customer_wishlist');
    }

    public function cart()
    {
        return $this->belongsToMany(Product::class, 'cart_user')
            ->withPivot('quantity');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
