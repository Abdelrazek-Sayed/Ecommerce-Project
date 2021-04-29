@extends('web.layout')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('web/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/product_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/product_responsive.css') }}">



@endsection

@section('content')

    <!-- Single Product -->

    <div class="single_product">
        <div class="container">
            <div class="row">

                <!-- Images -->
                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">
                        <li data-image="{{ asset("uploads/$product->image_one") }}"><img
                                src="{{ asset("uploads/$product->image_one") }}" alt=""
                                style="height:150px; width:250px;"></li>
                        <li data-image="{{ asset("uploads/$product->image_two") }}"><img
                                src="{{ asset("uploads/$product->image_two") }}" alt=""
                                style="height:150px; width:250px;"></li>
                        <li data-image="{{ asset("uploads/$product->image_three") }}"><img
                                src="{{ asset("uploads/$product->image_three") }}" alt=""
                                style="height:150px; width:250px;"></li>
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class="col-lg-5 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{ asset("uploads/$product->image_one") }}" alt=""></div>
                </div>

                <!-- Description -->
                <div class="col-lg-5 order-3">
                    <div class="product_description">
                        <div class="product_category">
                            <h5>{{ $product->category->name }} > {{ $product->subcat->name }}</h5>
                        </div>
                        <div class="product_name">{{ $product->name }}</div>
                        <div class="rating_r rating_r_4 product_rating" style="color:red;">{{ $product->brand->name }}
                        </div>
                        <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                        <div class="product_text">

                            <p>{!! str_limit($product->details, $limit = 300) !!}</p>
                        </div>
                        <div class="order_info d-flex flex-row">
                            <form action="{{ url("web/cart/product/add/$product->id") }}" method="POST">
                                @csrf
                                <div class="row">
                                    @if ($product->color != null)
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleFormcontrolSelect1">Color</label>
                                                <select class="form-control" id="exampleFormcontrolSelect1" name="color">
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color }}">{{ $color }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($product->size != null)
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleFormcontrolSelect1">Size</label>
                                                <select class="form-control" id="exampleFormcontrolSelect1" name="size">
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size }}">{{ $size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormcontrolSelect1">Quantity</label>
                                            <input class="form-control" id="quantity_input" type="number" name="qty"
                                                pattern="[0-9]*" value="1">
                                        </div>
                                    </div>
                                </div>
                                @php
                                    if ($product->discount != null) {
                                        $newPrice = $product->price - $product->price * ($product->discount / 100);
                                    }
                                @endphp
                                @if ($product->discount == null)
                                    <div class="product_price">
                                        {{ $product->price }}
                                    </div>
                                @else
                                    <div class="product_price">{{ $newPrice }}</div>
                                    <div class="viewed_price">
                                        <span>{{ $product->price }}</span>
                                    </div>
                                @endif
                                <div class="button_container">
                                    <button type="submit" class="button cart_button" data-id="{{ $product->id }}">Add to
                                        Cart</button>
                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                </div>
                                <br><br>

                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_inline_share_toolbox"></div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Recently Viewed -->

    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Product Data</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">video Link </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Product Review</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            {!! $product->details !!}</div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br> <a
                                href="{{ $product->video_link }}">{{ $product->video_link }}</a></div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><br>
                            <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <script src="{{ asset('web/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ asset('web/plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('web/js/product_custom.js') }}"></script>


    <div id="fb-root"></div>
    {{-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v10.0" nonce="8ZmFPhIA"></script> --}}
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0"
        nonce="8ZmFPhIA"></script>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60881e71fd1167d6"></script>

@endsection
