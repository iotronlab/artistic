<?php

namespace App\Http\Middleware\Cart;

use App\Helpers\Cart;
use Closure;
use Illuminate\Http\Request;

class CartSync
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $cart;

    public function __construct(Cart $cart)

    {
        $this->cart = $cart;
    }

    public function handle(Request $request, Closure $next)
    {
        $this->cart->sync();
        if ($this->cart->hasChanged()) {
            return response()->json(['message' => 'Item stocks have changed.'], 409);
        }
        return $next($request);
    }
}
