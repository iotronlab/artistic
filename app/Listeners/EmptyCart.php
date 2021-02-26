<?php

namespace App\Listeners;

use App\Events\Order\OrderPlaced;
use App\Helpers\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmptyCart
{
    protected $cart;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle the event.
     *
     * @param  OrderPlaced  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        $this->cart->empty();
    }
}
