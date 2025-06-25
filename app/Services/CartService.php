<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Category;

class CartService
{
    public static function store(array $data): Cart
    {

        $value = session()->get('counter');
        if($value){
            session()->put('counter', $value + 1);
        }else {
            session()->put('counter', 1);
        }
        return Cart::create(array_merge($data, ['session_id' => session()->getId()]));
    }

    public static function update(Cart $cart, array $data): Cart
    {
        $value = session()->get('counter');
        if($data['action'] === 'minus'){
            session()->put('counter', $value - 1);
        }
        if($data['action'] === 'plus'){
            session()->put('counter', $value + 1);
        }
        unset($data['action']);
        $cart->update($data);
        return $cart->fresh();
    }
}
