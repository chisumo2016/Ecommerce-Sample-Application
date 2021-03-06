@extends('layouts.app')
@section('title')
    Checkout
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <h1>Checkout</h1>
        <h4>Your Total: £{{ $total }}</h4>
        <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">{{ Session::get('error') }}</div>
        <form action="{{ route('checkout') }}" method="post" id="checkout-form-javascript">
            @csrf
            <div class="row">
                <div class="col-xs-12">
                   <div class="form-group">
                       <label for="name">Name</label>
                       <input type="text" name="name" id="name" class="form-control" required>
                   </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="name">Card Holder Name</label>
                        <input type="text" id="card-name" class="form-control" required>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="name">Credit Card Number</label>
                        <input type="text" id="credit-number" class="form-control" required>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="card-expiry-month">Expiration Month</label>
                                <input type="text" id="card-expiry-month" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="form-group">
                              <label for="card-expiry-year">Expiration Year</label>
                              <input type="text" id="card-expiry-year" class="form-control" required>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="card-cvc">CVC</label>
                        <input type="text" id="card-cvc" class="form-control" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Buy Now</button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://js.stripe.com/v2/"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ URL::to('js/checkout.js') }}"></script>
@endsection
