@extends('layouts.app')
@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
    @if(Session::has('success'))
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                <div id="charge-message" class="alert alert-success">{{ Session::get('success') }}</div>
            </div>
        </div>
    @endif
    <div class="product-section">
        <div class="row">
            <div class="col-md-12">
                <h1 class="product-title"> Display All Product</h1>
                <p class="sub-title">
                    Lorem ipsum dolor sit  quas quidem quos ratione recusandae sint suscipit unde. Aperiam cum delectus dicta dolore eius excepturi exercitationem perspiciatis veniam.Ad adipisci aliquid architecto consectetur debitis dicta eligendi iusto laborum molestias mollitia non perferendis quibusdam repudiandae rerum sed, sint sit
                </p>
            </div>

            <div class="product-shop">
                @foreach($products->chunk(3) as $productChuck)
                    <div class="row">
                        @foreach($productChuck as $product)
                            <div class="col-md-4 col-sm-6">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top img-responsive" src="{{ $product->image_path }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->title  }}</h5>
                                        <p class="card-text description">{{ $product->description  }}</p>
                                        <div>
                                            <div>
                                                <a href="#" class="float-left price"> £{{ $product->price  }}</a>
                                            </div>
                                            <a href="{{ route('Product.addToCart',['id' => $product->id]) }}" class="btn btn-success float-right">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                 @endforeach
            </div>

        </div>
    </div>

@endsection
