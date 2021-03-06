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
    protected $subtotal;
    public $shippingRate = 0;

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
        $this->subtotal =  $this->customer->cart->sum(function ($product) {
            return ($product->flat->price->amount() * $product->pivot->quantity);
        });
        return new Money($this->subtotal);
    }

    public function total()
    {
        $total = $this->subtotal;
        $discount = 0;
        // if ($code != null) {
        //     $discount = 0;
        //     //$this->ApplyCoupon($code);
        // }
        $shipping =  $this->customer->cart->sum('pivot.shipping_rate');

        if ($shipping > 0) {
            $total = $total + $shipping;
            //$this->subtotal()->add(new Money($this->shippingRate));
            //->subtract($discount);
            // ->add($this->applyTax());
        }
        return new Money($total);
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
    public function setShipping($products)
    {

        $productShipping =  $this->getShippingPayload($products);

        $this->customer->cart()->sync(
            $productShipping
        );
    }
    protected function getShippingPayload($products)
    {
        return collect($products)->keyBy('id')->map(function ($product) {
            return [
                'courier_id' => $product['courier_id'],
                'courier_name' => $product['courier_name'],
                'shipping_rate' => $product['shipping_rate'] * 100,
            ];
        })->toArray();
    }

    protected function getStorePayload($products)
    {
        return collect($products)->keyBy('id')->map(function ($product) {
            return [
                'quantity' => $product['quantity'] + $this->getCurrentQuantity($product['id'])
            ];
        })->toArray();
    }

    protected function getCurrentQuantity($productId)
    {
        if ($product = $this->customer->cart->where('id', $productId)->first()) {
            return $product->pivot->quantity;
        }
        return 0;
    }
}
