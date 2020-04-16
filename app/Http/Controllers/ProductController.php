<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Str;
use Session;
use Stripe\Charge;
use Stripe\Stripe;
use  App\Order;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('shop.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public  function  AddCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart =  new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
//        dd($request->session()->get('cart'));
        return redirect()->route('product.index');

    }

    public  function  ShopCart()
    {
        if (!Session::has('cart')){
            return view('shop.shoppingCart');
            //return view('shop.shoppingCart',['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shoppingCart',
            [
                'products'   => $cart->items,
                'totalPrice' => $cart->totalPrice,
            ]);
    }

    public  function   checkout()
    {
        if (!Session::has('cart')){
            return view('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout',['total' => $total]);
    }

    public  function  postCheckout(Request $request)
    {
       //dd($request->all());
        if (!Session::has('cart')){
            return redirect()->route('shop.shoppingCart');
        }
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

            Stripe::SetApiKey(env('STRIPE_SECRET'));
//            https://stripe.com/docs/api/charges/create?lang=php  https://stripe.com/docs/api/charges/create?lang=php
            try {
               $charge = Charge::create([
                    'amount' => $cart->totalPrice * 100,
                    'currency' => 'gbp',
                    'source' => $request->input('stripeToken'),
                    'description' => 'My First Test Charge ',
                ]);

                //Saving  Order
                $order = new Order();
                $order->cart = serialize($cart);
                $order->address = $request->address;
                $order->name = $request->name;
                $order->payment_id = $charge->id; //read stripe on setting

                //Relation
                Auth::user()->orders()->save($order);

            }catch (\Exception $e){
                return redirect()->route('checkout')->with('error', $e->getMessage());
            }

            Session::forget('cart');//delete from session
            return redirect()->route('product.index')->with('success','Successfully Purchased Products');

    }
}
