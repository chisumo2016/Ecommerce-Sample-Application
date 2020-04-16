<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public  function  getProfile()
    {
        $orders = Auth::user()->orders;
        //dd($orders);
        $orders->transform(function ($order, $key){
            $order->cart = unserialize($order->cart); // put into object
            return $order;
        });
        return view('users.profile',compact('orders'));
    }
}
