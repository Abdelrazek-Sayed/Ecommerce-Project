@extends('web.layout')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/contact_responsive.css') }}">


    <link rel="stylesheet" href="{{ asset('user/backend/panel/assets/css/all.min.css') }}">


    <style>
        /**
                                                 * The CSS shown here will not be introduced in the Quickstart guide, but shows
                                                 * how you can use CSS to style your Element's container.
                                                 */
        .StripeElement {
            box-sizing: border-box;

            height: 40px;
            width: 100%;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

    </style>



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
                                    style="float: right;">{{ $subtotal }}</span>
                            </li>
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
                    <h2 class="text-center">MasterCard</h2>

                    <form action="{{ route('stripe.charge') }}" method="post" id="payment-form">
                        @csrf
                        <div class="form-row">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div><br>

                        <input type="hidden" name="shipping_charge" value="{{ $setting->shipping_charge }}">
                        <input type="hidden" name="vat" value="{{ $setting->vat }}">
                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                        <input type="hidden" name="total"
                            value="{{ $subtotal + $setting->shipping_charge + $setting->vat }}">

                        <input type="hidden" name="ship_name" value="{{ $data['name'] }}">
                        <input type="hidden" name="ship_phone" value="{{ $data['phone'] }}">
                        <input type="hidden" name="ship_email" value="{{ $data['email'] }}">
                        <input type="hidden" name="ship_address" value="{{ $data['address'] }}">
                        <input type="hidden" name="ship_city" value="{{ $data['city'] }}">
                        <input type="hidden" name="payment_type" value="{{ $data['payment_type'] }}">

                        <button class="btn btn-info">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')



    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        // Create a Stripe client.
        var stripe = Stripe(
            'pk_test_51Ij40OGOmOZDR7EDM4GFwyMjg33Fa2KXxBugQMrqNznQx40U1fPxeE52W1IxgH7DkLEEqbdMsoART6p4SATO1e9y00aNzKahcY'
        );

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

    </script>


@endsection
