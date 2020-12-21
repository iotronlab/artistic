<?php

namespace App\Helpers;

use App\Helpers\Money;
use App\Models\Customer\Customer;
use App\Models\Order\ShippingMethod;

class Cart
{
    protected $changed = false;
    protected $customer;
    protected $shipping;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

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
        return $this->customer->cart->sum('pivot.quantity') === 0;
    }

    public function subtotal()
    {
        $subtotal =  $this->customer->cart->sum(function ($product) {
            return ($product->flat->price->amount()   * $product->pivot->quantity);
        });
        return new Money($subtotal);
    }

    public function total()
    {
        if ($this->shipping) {
            return $this->subtotal()->add($this->shipping->price);
        }
        return $this->subtotal();
    }

    public function sync()
    {
        return
            $this->customer->cart->each(function ($product) {
                $quantity = $product->minStock($product->pivot->quantity);
                $this->changed = $quantity != $product->quantity;
                $product->pivot->update([
                    'quantity' => $quantity
                ]);
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
