<?php

namespace App\Helpers;

use App\Helpers\Money;
use App\Models\CartRule\CartRule;
use App\Models\Customer\Customer;
use App\Models\Order\ShippingMethod;
use App\Models\Tax\TaxCategory;
use Illuminate\Support\Arr;

class Cart
{
    protected $changed = false;
    protected $customer;
    protected $shipping;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    // public function ApplyCoupon($coupon_code)
    // {
    //     $rule = CartRule::where('coupon_code', $coupon_code)->first();

    //     ///validation to check if it belongs to specific customer group
    //     $valid = false;
    //     foreach ($rule->customer_groups as $customer) {
    //         if ($customer->id == $this->customer->customer_group_id) {
    //             $valid = true;
    //         }
    //     }
    //     if (!$valid) {
    //         return new Money((int)0);
    //     }
    //     //Check if the coupon satisfies min quantity
    //     if ($this->customer->cart->sum('pivot.quantity') < $rule->min_quantity) {
    //         return new Money((int)0);
    //     }

    //     if ($rule->action_type == "by_fixed") {
    //         $discount = $rule->discount_amount;
    //     } else {
    //         $discount = (($rule->discount_amount) * $this->subtotal()->amount()) / 100;
    //     }
    //     return new Money((int)$discount);
    // }

    public function WithShipping($id)
    {
        $this->shipping = ShippingMethod::find($id);
        return $this;
    }
    public function products()
    {
        return $this->customer->cart;
    }

    public function add($products)
    {
        $this->customer->cart()->syncWithoutDetaching(
            $this->getStorePayload($products)
        );
    }
    public function update($productId, $quantity)
    {
        $this->customer->cart()->updateExistingPivot($productId, [
            'quantity' => $quantity,
        ]);
    }


    public function delete($productId)
    {
        $this->customer->cart()->detach($productId);
    }


    public function empty()
    {
        $this->customer->cart()->detach();
    }

    public function isEmpty()
    {
        return $this->customer->cart->sum('pivot.quantity') <= 0;
    }

    // public function applyTax()
    // {
    //     $tax =  $this->customer->cart->sum(function ($product) {
    //         $t = TaxCategory::find($product->flat->tax_category_id);
    //         return (($product->flat->price->amount() * $product->pivot->quantity * $t->percent) / 100);
    //     });
    //     return new Money((int)$tax);
    // }

    public function subtotal()
    {
        $subtotal =  $this->customer->cart->sum(function ($product) {
            return ($product->flat->price->amount() * $product->pivot->quantity);
        });
        return new Money($subtotal);
    }

    public function total($code = null)
    {
        $discount = 0;
        if ($code != null) {
            $discount = 0;
            //$this->ApplyCoupon($code);
        }
        if ($this->shipping) {
            return $this->subtotal();
            //->add($this->shipping->price)->subtract($discount);
            // ->add($this->applyTax());
        }
        return $this->subtotal();
        //->subtract($discount);
        //->add($this->applyTax());
    }

    public function sync()
    { //query increases 6
        return
            $this->customer->cart->each(function ($product) {
                $quantity = $product->minStock($product->pivot->quantity);
                $this->changed = $quantity != $product->pivot->quantity;
                if ($this->changed == true) {
                    $product->pivot->update([
                        'quantity' => $quantity
                    ]);
                }
            });
    }

    public function hasChanged()
    {
        return $this->changed;
    }

    protected function getStorePayload($products)
    {
        return collect($products)->keyBy('id')->map(function ($product) {
            return [
                'quantity' => $product['quantity'] + $this->getCurrentQuantity($product['id'])
            ];
        })
            ->toArray();
    }

    protected function getCurrentQuantity($productId)
    {
        if ($product = $this->customer->cart->where('id', $productId)->first()) {
            return $product->pivot->quantity;
        }
        return 0;
    }
}
