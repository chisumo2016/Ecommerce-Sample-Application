@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            <h1>User Profile</h1>
            <h4>My Orders</h4>
            @foreach( $orders as $order)
                <div class="card">
                    <div class="card-header">
                        Featured
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach( $order->cart->items as $item)
                                <li class="list-group-item">
                                    <span class="badge float-right">£ {{ $item['price'] }} </span>
                                    {{ $item['item']['title']  }} |  {{ $item['qty'] }} units
                                </li>
                            @endforeach

                        </ul>
                    </div>

                    <div class="card-footer">
                        <strong> Total Price : $  {{ $order->cart->totalPrice }}</strong>
                    </div>
                </div>

              @endforeach
        </div>
    </div>
@endsection
