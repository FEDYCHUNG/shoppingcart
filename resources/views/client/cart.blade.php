@extends('client_layout.client')

@section('title')
    Cart
@endsection

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('frontend/images/bg_1.jpg') }}">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span>
                        <span>Cart</span>
                    </p>
                    <h1 class="bread mb-0">My Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($carts)
                                    @foreach ($carts->items as $product)
                                        <tr class="text-center">
                                            <td class="product-remove">
                                                <form method="post" action="{{ route('remove_from_cart', ['id' => $product['product_id']]) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <a href="javascript:;" onclick="parentNode.submit();"><span class="ion-ios-close"></span></a>
                                                </form>
                                            </td>

                                            <td class="image-prod">
                                                <div class="img" style="background-image:url('{{ asset('storage/product_images/' . $product['product_image']) }}');">
                                                </div>
                                            </td>

                                            <td class="product-name">
                                                <h3>{{ $product['product_name'] }}</h3>
                                                {{-- <p>Far far away, behind the word mountains, far from the countries</p> --}}
                                            </td>

                                            <td class="price">Rp. {{ number_format($product['product_price'], '2', '.', ',') }}</td>

                                            <td class="quantity">
                                                <form method="post" action="{{ route('update_qty', ['id' => $product['product_id']]) }}">
                                                    @method('put')
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <input type="number" name="quantity" class="quantity form-control input-number" value="{{ $product['qty'] }}" min="1" max="100">
                                                    </div>
                                                    <input type="submit" class="btn btn-success" value="Validate">
                                                </form>
                                            </td>
                                            <td class="total">Rp. {{ number_format($product['product_price'] * $product['qty'], '2', '.', ',') }}</td>
                                        </tr><!-- END TR-->
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-lg-4 cart-wrap ftco-animate mt-5">
                    <div class="cart-total mb-3">
                        <h3>Coupon Code</h3>
                        <p>Enter your coupon code if you have one</p>
                        <form action="#" class="info">
                            <div class="form-group">
                                <label for="">Coupon code</label>
                                <input type="text" class="form-control px-3 text-left" placeholder="">
                            </div>
                        </form>
                    </div>
                    <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
                </div>
                <div class="col-lg-4 cart-wrap ftco-animate mt-5">
                    <div class="cart-total mb-3">
                        <h3>Estimate shipping and tax</h3>
                        <p>Enter your destination to get a shipping estimate</p>
                        <form action="#" class="info">
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" class="form-control px-3 text-left" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">State/Province</label>
                                <input type="text" class="form-control px-3 text-left" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">Zip/Postal Code</label>
                                <input type="text" class="form-control px-3 text-left" placeholder="">
                            </div>
                        </form>
                    </div>
                    <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
                </div>
                <div class="col-lg-4 cart-wrap ftco-animate mt-5">
                    @php
                        $total_price = $carts ? $carts->total_price : 0;
                    @endphp
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>Rp. {{ number_format($total_price, '2', '.', ',') }}</span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span>Rp. {{ number_format($delivery_price, '2', '.', ',') }}</span>
                        </p>
                        <p class="d-flex">
                            <span>Discount</span>
                            <span>Rp. {{ number_format($discount, '2', '.', ',') }}</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>Rp. {{ number_format($total_price + $delivery_price - $discount, '2', '.', ',') }}</span>
                        </p>
                    </div>
                    <p><a href="{{ url('/checkout') }}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function(e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>
@endsection
