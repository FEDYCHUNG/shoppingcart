@extends('client_layout.client')

@section('title')
    Shop
@endsection

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('frontend/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span>
                        <span>Products</span>
                    </p>
                    <h1 class="bread mb-0">Products</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mb-5 text-center">
                    <ul class="product-category">
                        <li><a href="{{ route('shop') }}" class="{{ request()->is('shop') ? 'active' : '' }}">All</a></li>
                        @if ($categories)
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('shop', ['id' => strval($category->id)]) }}" class="{{ request()->is('shop/' . strval($category->id)) ? 'active' : '' }}">
                                        {{ $category->category_name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="row">
                @if ($products)
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-3 ftco-animate">
                            <div class="product">
                                <a href="#" class="img-prod">
                                    <img class="img-fluid" src="{{ asset('storage/product_images/' . $product->product_image) }}" alt="Colorlib Template">
                                    {{-- <span class="status">30%</span> --}}
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 px-3 pb-4 text-center">
                                    <h3><a href="#">{{ $product->product_name }}</a></h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price">
                                                {{-- <span class="price-dc mr-2">$120.00</span> --}}
                                                <span class="price-sale">Rp. {{ number_format($product->product_price, '2', '.', ',') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="bottom-area d-flex px-3">
                                        <div class="d-flex m-auto">
                                            <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                                <span><i class="ion-ios-menu"></i></span>
                                            </a>
                                            <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                                <span><i class="ion-ios-cart"></i></span>
                                            </a>
                                            <a href="#" class="heart d-flex justify-content-center align-items-center">
                                                <span><i class="ion-ios-heart"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        {{ $products->links('vendor.pagination.client-custom') }}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
