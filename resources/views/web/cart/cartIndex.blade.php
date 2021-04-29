@extends('web.layout')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('web/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/cart_responsive.css') }}">
@endsection

@section('content')
@include('web.includes.menu_bar')
    <!-- Cart -->

    {{-- <div class="cart_section"> --}}
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart_container">
                    <div class="cart_title">Shopping Cart</div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            @foreach ($carts as $cart)
                                <li class="cart_item clearfix">
                                    <div class="cart_item_image"><img src="{{ asset("$cart->options->image") }}" alt="">
                                    </div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Name</div>
                                            <div class="cart_item_text">{{ $cart->name }}</div>
                                        </div>
                                        @if ($cart->options->color)
                                            <div class="cart_item_color cart_info_col">
                                                <div class="cart_item_title">Color</div>
                                                <div class="cart_item_text">{{ $cart->options->color }}</div>
                                            </div>
                                        @endif
                                        @if ($cart->options->size)
                                            <div class="cart_item_color cart_info_col">
                                                <div class="cart_item_title">Size</div>
                                                <div class="cart_item_text">{{ $cart->options->size }}</div>
                                            </div>
                                        @endif
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Quantity</div><br>
                                            <form method="POST" action="{{ route('cart.update') }}">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $cart->rowId }}">
                                                <input type="number" name="qty" value="{{ $cart->qty }}" style="width:30px;">
                                                <button class="btn btn-sm btn-success"><i class="fa fa-check-square"></i></button>
                                            </form>
                                        </div>
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_title">Price</div>
                                            <div class="cart_item_text">{{ $cart->price }}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Total</div>
                                            <div class="cart_item_text">{{ $cart->price * $cart->qty }}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Action</div>
                                            <br>
                                            <a href="{{ url("web/cart/product/remove/$cart->rowId") }}"
                                                class="btn btn-sm btn-danger">X</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Order Total -->
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Total :</div>
                            <div class="order_total_amount">{{ Cart::subtotal() }}</div>
                        </div>
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Total With Tax 21% :</div>
                            <div class="order_total_amount">{{ Cart::total() }}</div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <button type="button" class="button cart_button_clear">All Cancel</button>
                        <a href="{{ route('user.checkout') }}" class="button cart_button_checkout">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}



@endsection

@section('script')
    <script src="{{ asset('web/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('web/styles/bootstrap4/popper.js') }}"></script>
    <script src="{{ asset('web/styles/bootstrap4/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web/plugins/greensock/TweenMax.min.js') }}"></script>
    <script src="{{ asset('web/plugins/greensock/TimelineMax.min.js') }}"></script>
    <script src="{{ asset('web/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
    <script src="{{ asset('web/plugins/greensock/animation.gsap.min.js') }}"></script>
    <script src="{{ asset('web/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
    <script src="{{ asset('web/plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('web/js/cart_custom.js') }}"></script>
@endsection
