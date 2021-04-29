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
                    <div class="cart_title">Wishlists</div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            @foreach ($wishlists as $wishlist)
                                <div class="card">
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image">
                                            <img
                                                src="{{ asset("uploads/$wishlist->product->image_one") }}" alt=""
                                                style="height:100px; width:100px;">
                                        </div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="card-header text-center">
                                                    <div class="cart_item_title text-center">Name</div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="cart_item_text">{{ $wishlist->product->name }}</div>
                                                </div>
                                            </div>
                                            @if ($wishlist->product->color)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="card-header">
                                                        <div class="cart_item_title text-center">Color</div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="cart_item_text">{{ $wishlist->product->color }}</div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($wishlist->product->size)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="card-header">
                                                        <div class="cart_item_title text-center">Size</div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="cart_item_text">{{ $wishlist->product->size }}</div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="cart_item_total cart_info_col">
                                                <div class="card-header">
                                                    <div class="cart_item_title text-center">Action</div>
                                                </div>
                                                <div class="card-body">
                                                    <a href="{{ url("web/add/to/cart/$wishlist->product->id") }}"
                                                        class="btn btn-lg btn-success"> Add To Cart</a>
                                                </div>

                                            </div>
                                        </div>
                                    </li>

                                </div>
                            @endforeach
                        </ul>
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
