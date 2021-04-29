@extends('web.layout')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/contact_responsive.css') }}">


    <link rel="stylesheet" href="{{ asset('user/backend/panel/assets/css/all.min.css') }}">
@endsection
@section('content')
    @include('web.includes.menu_bar')
    <div class="contact_info">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-7" style="border: 1px solid grey; border-radius:25px;">
                    <h2 class=" text-center">Cart Product</h2>
                    <br>
                    <div class="contact_form_container">
                        <table class="table text-center">
                            <thead>
                                <tr>

                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            @foreach ($carts as $cart)
                                <tbody class="text-center">
                                    <tr>
                                        <th scope="row">
                                            <div class="cart_item_image"><img src="{{ asset("$cart->options->image") }}"
                                                    alt="">
                                            </div>
                                        </th>
                                        <td>
                                            <div class="cart_item_text text-center">{{ $cart->name }}</div>
                                        </td>
                                        <td>
                                            @if ($cart->options->color)

                                                <div class="cart_item_text text-center">{{ $cart->options->color }}</div>

                                            @endif

                                        </td>
                                        <td>
                                            @if ($cart->options->size)

                                                <div class="cart_item_text text-center">{{ $cart->options->size }}</div>

                                            @endif

                                        </td>
                                        <td>
                                            <div class="cart_item_text text-center">{{ $cart->qty }}</div>
                                        </td>

                                        <td>
                                            <div class="cart_item_text text-center">{{ $cart->price }}</div>
                                        </td>

                                        <td>

                                            <div class="cart_item_text text-center">{{ $cart->price * $cart->qty }}
                                        </td>
                                    </tr>

                                </tbody>
                            @endforeach
                        </table>
                        {{-- <div class="card-body">
                            <ul class="cart_list">
                                @foreach ($carts as $cart)
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title"><b>Image</b></div>
                                                <div class="cart_item_image"><img
                                                        src="{{ asset("$cart->options->image") }}" alt="">
                                                </div>
                                            </div>

                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title"><b>Name</b> </div><br>
                                                <div class="cart_item_text text-center">{{ $cart->name }}</div>
                                            </div>
                                            @if ($cart->options->color)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title"><b>Color</b></div><br>
                                                    <div class="cart_item_text text-center">{{ $cart->options->color }}
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($cart->options->size)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title"><b>Size</b></div><br>
                                                    <div class="cart_item_text text-center">{{ $cart->options->size }}
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title"><b>Quantity</b></div><br>
                                                <div class="cart_item_text text-center">{{ $cart->qty }}</div>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title"><b>Price</b></div><br>
                                                <div class="cart_item_text text-center">{{ $cart->price }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title"><b>Total</b></div><br>
                                                <div class="cart_item_text text-center">{{ $cart->price * $cart->qty }}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div> --}}
                        <br>
                        <hr>
                        @php
                            if (Session::has('coupon')) {
                                $subtotal = Cart::subtotal() - Session::get('coupon')['discount'];
                            } else {
                                $subtotal = Cart::subtotal();
                            }
                        @endphp
                        <ul class="list-group col-lg-6" style="float: right;">
                            <li class="list-group-item" style="float: right;">Subtotal : <span
                                    style="float: right;">{{ $subtotal }}</span></li>
                            @if (Session::has('coupon'))
                                <li class="list-group-item" style="float: right;">Coupon :
                                    ({{ Session::get('coupon')['name'] }}) <a href="{{ url('web/coupon/remove/') }}"
                                        class="btn btn-sm btn-danger">Remove Coupon ?</a><span
                                        style="float: right;">{{ Session::get('coupon')['discount'] }}</span>
                                </li>
                            @else
                                <li class="list-group-item" style="float: right;">Coupon : <span style="float: right;">Enter
                                        Coupon</span>
                                </li>
                            @endif
                            <li class="list-group-item" style="float: right;">Shipping Charge :
                                <span style="float: right;">{{ $setting->shipping_charge }} </span>
                            </li>
                            <li class="list-group-item" style="float: right;">Vat :<span style="float: right;">
                                    {{ $setting->vat }} </span></li>

                            <li class="list-group-item" style="float: right;">Total :
                                <span
                                    style="float: right;">{{ $subtotal + $setting->shipping_charge + $setting->vat }}</span>
                            </li>


                        </ul>

                    </div>
                </div>

                <div class="col-lg-5" style="border: 1px solid grey; border-radius:25px;">
                    <h2 class="text-center">Shipping Address</h2>
                    <br>
                    <div class="form-group">
                        <form method="POST" action="{{ route('payment.process') }}">
                            @csrf
                            <div class="form-group">
                                <label for="uname">Full Name</label>
                                <input id="name" type="text" class="form-control" name="name" >
                            </div>
                            <div class="form-group">
                                <label for="uname">Email</label>
                                <input id="email" type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="uname">Phone</label>
                                <input id="phone" type="text" class="form-control" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="uname">Address</label>
                                <input id="address" type="text" class="form-control" name="address">
                            </div>
                            <div class="form-group">
                                <label for="uname">City</label>
                                <input id="city" type="text" class="form-control" name="city">
                            </div>
                            <div class="contact_form_title text-center">Payment By</div>
                            <div class="form-group">
                                <ul class="logos_list">
                                    <li><input type="radio" name="payment_type" value="stripe"><img
                                            src="{{ asset('web/images/mastercard.png') }}"
                                            style="width: 100px; height:60px;"></li>

                                    <li><input type="radio" name="payment_type" value="paypal"><img
                                            src="{{ asset('web/images/paypal.png') }}"
                                            style="width: 100px; height:60px;">
                                    </li>
                                    <li><input type="radio" name="payment_type" value="cash"><img
                                            src="{{ asset('web/images/cash.jpg') }}"
                                            style="width: 100px; height:60px; margin-left:5px;">
                                    </li>
                                </ul>
                            </div>
                            <div class="contact_form_button text-center">
                                <button type="submit" class="btn btn-info">PayNow</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
