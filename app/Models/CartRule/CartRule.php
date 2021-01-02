<?php

namespace App\Models\CartRule;

use App\Models\Customer\CustomerGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartRule extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status',
        'coupon_code',
        'times_used',
        'action_type',
        'discount_amount',
        'max_discount',
        'min_quantity',
        'apply_to_shipping',
        'free_shipping'
    ];
    /**
     * Get the customer groups that owns the cart rule.
     */
    public function customer_groups()
    {
        return $this->belongsToMany(CustomerGroup::class, 'cart_rule_customer_groups');
    }
}
