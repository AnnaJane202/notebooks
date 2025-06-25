<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Cart\StoreRequest;
use App\Http\Requests\Client\Cart\UpdateRequest;
use App\Http\Resources\Cart\CartResource;
use App\Http\Resources\Cart\CartWithProductAndTotalSumResource;
use App\Http\Resources\Cart\CartWithProductResource;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function index()
    {

        $carts = CartWithProductResource::collection(Cart::where('session_id', session()->getId())->get())->resolve();
        $ct = session()->get('counter');
//        dd($carts);
        return inertia('Client/Cart/Index', compact('carts', 'ct'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $cart = CartService::store($data);
        $ct = session()->get('counter');
        $cart = CartWithProductResource::make($cart)->resolve();


        return \response()->json([
            'cart' => $cart,
            'ct' => $ct
        ]);


    }

    public function update(Cart $cart, UpdateRequest $request)
    {
        $data = $request->validated();
        $cart = CartService::update($cart, $data);
        $ct = session()->get('counter');
        $cart = CartWithProductResource::make($cart)->resolve();
//        return CartWithProductResource::make($cart)->resolve();

        return \response()->json([
            'cart' => $cart,
            'ct' => $ct
        ]);
    }

    public function destroy(Cart $cart)
    {
        $ct = session()->get('counter') - $cart->qty;
        session()->put('counter', $ct);
        $cart->delete();
        return response()->json([
            'message' => 'deleted',
            'ct' => $ct
        ], Response::HTTP_OK);
    }
}
