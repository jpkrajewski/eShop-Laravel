<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;
use App\Models\Cart;

class CartService
{

	protected $cookieName;
    protected $cookieExpiration;

    public function __construct()
    {
        $this->cookieName = config('cart.cookie.name');
        $this->cookieExpiration = config('cart.cookie.expiration');
    }

	public function getFromCookie()
	{
		$cartId = Cookie::get($this->cookieName);

        return Cart::find($cartId);
	}

	public function getFromCookiOrCreate()
    {
    	$cart = $this->getFromCookie();

        return $cart ?? Cart::create();
    }

    public function makeCookie(Cart $cart)
    {
    	return Cookie::make($this->cookieName, $cart->id, 7*24*60);
    }

    public function countProducts()
    {
    	$cart = $this->getFromCookie();

    	if ($cart != null)
    	{
    		return $cart->products->pluck('pivot.quantity')->sum();
    	}

    	return 0;
    }
}