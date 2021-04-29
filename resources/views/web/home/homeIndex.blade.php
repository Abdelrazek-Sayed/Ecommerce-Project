@extends('web.layout')
@section('content')

    @php
    $brands = App\Models\Brand::get();
    $featuredProducst = App\Models\Product::where('status', 1)
        ->orderBy('id', 'desc')
        ->get();
    $trends = App\Models\Product::where([['status', 1], ['trend', 1]])->get();
    $bestRateds = App\Models\Product::where([['status', 1], ['best_rated', 1]])->get();
    $hots = App\Models\Product::where([['status', 1], ['hot_deal', 1]])
        ->latest()
        ->take(3)
        ->get();

    $midSliders = App\Models\Product::where([['status', 1], ['mid_slider', 1]])
        ->latest()
        ->take(3)
        ->get();

    $cats = App\Models\Category::get();
    $cat_1 = App\Models\Category::skip(0)->first();
    $cat_2 = App\Models\Category::skip(3)->first();
    $cat_1_id = $cat_1->id;
    $cat_2_id = $cat_2->id;
    $products_cat_one = App\Models\Product::where([['category_id', $cat_1_id], ['status', 1]])
        ->limit(10)
        ->latest()
        ->get();
    $products_cat_two = App\Models\Product::where([['category_id', $cat_2_id], ['status', 1]])
        ->limit(10)
        ->latest()
        ->get();

    $buyone_getone = App\Models\Product::where([['status', 1], ['buyone_getone', 1]])->get();

    @endphp

    @include('web.includes.menu_bar')
    @include('web.includes.slider')
    <!-- Characteristics -->

    <div class="characteristics">
        <div class="container">
            <div class="row">

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('web/images/char_1.png') }}" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Free Delivery</div>
                            <div class="char_subtitle">from $50</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Deals of the week -->

    <div class="deals_featured">
        <div class="container">
            <div class="row">
                <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

                    <!-- Deals -->

                    <div class="deals">
                        <div class="deals_title">Deals of the Week</div>
                        <div class="deals_slider_container">

                            <!-- Deals Slider -->
                            <div class="owl-carousel owl-theme deals_slider">
                                @foreach ($hots as $product)
                                    @php
                                        if ($product->discount != null) {
                                            $newPrice = $product->price - $product->price * ($product->discount / 100);
                                        }
                                    @endphp
                                    <!-- Deals Item -->
                                    <div class="owl-item deals_item">
                                        <div class="deals_image"><img src="{{ asset("uploads/$product->image_one") }}"
                                                alt="" style="height:300px; width:200px;">
                                        </div>
                                        <div class="deals_content">
                                            <div class="deals_info_line d-flex flex-row justify-content-start">
                                                <div class="deals_item_category"><a
                                                        href="#">{{ $product->brand->name }}</a></div>
                                                @if ($product->discount != null)
                                                    <div class="deals_item_price_a ml-auto">{{ $product->price }}</div>
                                                @endif
                                            </div>
                                            <div class="deals_info_line d-flex flex-row justify-content-start">
                                                <div class="deals_item_name">{{ $product->name }}</div>
                                                @if ($product->discount != null)
                                                    <div class="deals_item_price ml-auto">{{ $newPrice }}</div>
                                                @else
                                                    <div class="deals_item_price ml-auto">{{ $product->price }}</div>
                                                @endif
                                            </div>
                                            <div class="available">
                                                <div class="available_line d-flex flex-row justify-content-start">
                                                    <div class="available_title">Available:
                                                        <span>{{ $product->quantity }}</span>
                                                    </div>
                                                    <div class="sold_title ml-auto">Already sold: <span>28</span></div>
                                                </div>
                                                <div class="available_bar"><span style="width:17%"></span></div>
                                            </div>
                                            <div
                                                class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                                <div class="deals_timer_title_container">
                                                    <div class="deals_timer_title">Hurry Up</div>
                                                    <div class="deals_timer_subtitle">Offer ends in:</div>
                                                </div>
                                                <div class="deals_timer_content ml-auto">
                                                    <div class="deals_timer_box clearfix" data-target-time="">
                                                        <div class="deals_timer_unit">
                                                            <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                                                            <span>hours</span>
                                                        </div>
                                                        <div class="deals_timer_unit">
                                                            <div id="deals_timer1_min" class="deals_timer_min"></div>
                                                            <span>mins</span>
                                                        </div>
                                                        <div class="deals_timer_unit">
                                                            <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                                                            <span>secs</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="deals_slider_nav_container">
                            <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i>
                            </div>
                            <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Featured -->
                    <div class="featured">
                        <div class="tabbed_container">
                            <div class="tabs">
                                <ul class="clearfix">
                                    <li class="active">Featured</li>
                                </ul>
                                <div class="tabs_line"><span></span></div>
                            </div>

                            <!--featured Product Panel -->
                            <div class="product_panel panel active">
                                <div class="featured_slider slider">
                                    @foreach ($featuredProducst as $product)
                                        @php
                                            if ($product->discount != null) {
                                                $newPrice = $product->price - $product->price * ($product->discount / 100);
                                            }
                                        @endphp

                                        <!-- Slider Item -->
                                        <div class="featured_slider_item">
                                            <div class="border_active"></div>
                                            <div
                                                class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <div
                                                    class="product_image d-flex flex-column align-items-center justify-content-center">
                                                    <img src="{{ asset("uploads/$product->image_one") }}" alt=""
                                                        style="height:150px; width:50px;">
                                                </div>
                                                <div class="product_content">
                                                    @if ($product->discount != null)
                                                        <div class="product_price discount">
                                                            {{ $newPrice }}<span>{{ $product->price }}</span></div>

                                                    @else
                                                        <div class="product_price discount">{{ $product->price }}</div>
                                                    @endif
                                                    <div class="product_name">
                                                        <div><a
                                                                href="{{ url("web/product/details/$product->id") }}">{{ $product->name }}...</a>
                                                        </div>
                                                    </div>
                                                    <div class="product_extras">

                                                        <button id={{ $product->id }} onclick="productview(this.id)"
                                                            class="product_cart_button" data-toggle="modal"
                                                            data-target="#cartModal">Add to Cart</button>

                                                    </div>
                                                </div>

                                                <button class="addwishlist" data-id={{ $product->id }}>
                                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                </button>

                                                <ul class="product_marks">
                                                    @if ($product->discount != null)
                                                        <li class="product_mark product_discount">
                                                            -{{ $product->discount }}%
                                                        </li>
                                                    @else
                                                        <li class="product_mark product_discount" style="background:blue;">
                                                            New</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Popular Categories -->

    <div class="popular_categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="popular_categories_content">
                        <div class="popular_categories_title">Popular Categories</div>
                        <div class="popular_categories_slider_nav">
                            <div class="popular_categories_prev popular_categories_nav"><i
                                    class="fas fa-angle-left ml-auto"></i></div>
                            <div class="popular_categories_next popular_categories_nav"><i
                                    class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                        <div class="popular_categories_link"><a href="#">full catalog</a></div>
                    </div>
                </div>

                <!-- Popular Categories Slider -->

                <div class="col-lg-9">
                    <div class="popular_categories_slider_container">
                        <div class="owl-carousel owl-theme popular_categories_slider">
                            @foreach ($cats as $cat)

                                <!-- Popular Categories Item -->
                                <div class="owl-item">
                                    <div
                                        class="popular_category d-flex flex-column align-items-center justify-content-center">
                                        <div class="popular_category_image"><img
                                                src="{{ asset('web/images/popular_1.png') }}" alt=""></div>
                                        <div class="popular_category_text">{{ $cat->name }}</div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner -->

    <div class="banner_2">
        <div class="banner_2_background" style="background-image:url({{ asset('web/images/banner_2_background.jpg') }} ">
        </div>
        <div class="banner_2_container">
            <div class="banner_2_dots"></div>
            <!-- Banner 2 Slider -->

            <div class="owl-carousel owl-theme banner_2_slider">
                @foreach ($midSliders as $product)
                    <!-- Banner 2 Slider Item -->
                    <div class="owl-item">
                        <div class="banner_2_item">
                            <div class="container fill_height">
                                <div class="row fill_height">
                                    <div class="col-lg-4 col-md-6 fill_height">
                                        <div class="banner_2_content">
                                            <div class="banner_2_category">
                                                <h4>{{ $product->category->name }}</h4>
                                            </div>
                                            <div class="banner_2_title">{{ $product->name }}</div>
                                            <div class="banner_2_text">
                                                <h4>{{ $product->brand->name }}</h4>
                                            </div>
                                            <br>
                                            <h2>{{ $product->price }}</h2>
                                            <div class="rating_r rating_r_4 banner_2_rating">
                                                <i></i><i></i><i></i><i></i><i></i>
                                            </div>
                                            <div class="button banner_2_button"><a
                                                    href="{{ url("web/product/details/$product->id") }}">Explore</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6 fill_height">
                                        <div class="banner_2_image_container">
                                            <div class="banner_2_image"><img
                                                    src="{{ asset("uploads/$product->image_one") }}" alt=""
                                                    style="height:500px; width:600px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Category One  -->

    <div class="new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title">{{ $cat_1->name }}</div>
                            <ul class="clearfix">
                                <li class="active"></li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="z-index:1;">
                                <!-- Product Panel -->
                                <div class="product_panel panel active">
                                    <div class="arrivals_slider slider">
                                        <!-- Slider Item -->
                                        @foreach ($products_cat_one as $product)
                                            @php
                                                if ($product->discount != null) {
                                                    $newPrice = $product->price - $product->price * ($product->discount / 100);
                                                }
                                            @endphp

                                            <!-- Slider Item -->
                                            <div class="featured_slider_item">
                                                <div class="border_active"></div>
                                                <div
                                                    class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                    <div
                                                        class="product_image d-flex flex-column align-items-center justify-content-center">
                                                        <img src="{{ asset("uploads/$product->image_one") }}" alt=""
                                                            style="height:120px; width:100px;">
                                                    </div>
                                                    <div class="product_content">
                                                        @if ($product->discount != null)
                                                            <div class="product_price discount">
                                                                {{ $newPrice }}<span>{{ $product->price }}</span>
                                                            </div>

                                                        @else
                                                            <div class="product_price discount">{{ $product->price }}
                                                            </div>
                                                        @endif
                                                        <div class="product_name">
                                                            <div><a
                                                                    href="{{ url("web/product/details/$product->id") }}">{{ $product->name }}...</a>
                                                            </div>
                                                        </div>
                                                        <div class="product_extras">
                                                            <div class="product_color">
                                                                <input type="radio" checked name="product_color"
                                                                    style="background:#b19c83">
                                                                <input type="radio" name="product_color"
                                                                    style="background:#000000">
                                                                <input type="radio" name="product_color"
                                                                    style="background:#999999">
                                                            </div>
                                                            <button class="product_cart_button addcart"
                                                                data-id={{ $product->id }}>Add to Cart</button>
                                                        </div>
                                                    </div>
                                                    <button class="addwishlist" data-id={{ $product->id }}>
                                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                    </button>
                                                    <ul class="product_marks">
                                                        @if ($product->discount != null)
                                                            <li class="product_mark product_discount">
                                                                -{{ $product->discount }}%
                                                            </li>
                                                        @else
                                                            <li class="product_mark product_discount"
                                                                style="background:blue;">
                                                                New</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="arrivals_slider_dots_cover"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Category Two  -->


    <div class="new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title">{{ $cat_2->name }}</div>
                            <ul class="clearfix">
                                <li class="active"></li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="z-index:1;">
                                <!-- Product Panel -->
                                <div class="product_panel panel active">
                                    <div class="arrivals_slider slider">
                                        <!-- Slider Item -->
                                        @foreach ($products_cat_two as $product)
                                            @php
                                                if ($product->discount != null) {
                                                    $newPrice = $product->price - $product->price * ($product->discount / 100);
                                                }
                                            @endphp

                                            <!-- Slider Item -->
                                            <div class="featured_slider_item">
                                                <div class="border_active"></div>
                                                <div
                                                    class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                    <div
                                                        class="product_image d-flex flex-column align-items-center justify-content-center">
                                                        <img src="{{ asset("uploads/$product->image_one") }}" alt=""
                                                            style="height:120px; width:100px;">
                                                    </div>
                                                    <div class="product_content">
                                                        @if ($product->discount != null)
                                                            <div class="product_price discount">
                                                                {{ $newPrice }}<span>{{ $product->price }}</span>
                                                            </div>

                                                        @else
                                                            <div class="product_price discount">{{ $product->price }}
                                                            </div>
                                                        @endif
                                                        <div class="product_name">
                                                            <div><a
                                                                    href="{{ url("web/product/details/$product->id") }}">{{ $product->name }}...</a>
                                                            </div>
                                                        </div>
                                                        <div class="product_extras">

                                                            <button class="product_cart_button addcart"
                                                                data-id={{ $product->id }}>Add to Cart</button>
                                                        </div>
                                                    </div>
                                                    <button class="addwishlist" data-id={{ $product->id }}>
                                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                    </button>
                                                    <ul class="product_marks">
                                                        @if ($product->discount != null)
                                                            <li class="product_mark product_discount">
                                                                -{{ $product->discount }}%
                                                            </li>
                                                        @else
                                                            <li class="product_mark product_discount"
                                                                style="background:blue;">
                                                                New</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="arrivals_slider_dots_cover"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Best Sellers -->

    <div class="best_sellers">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title">Best Sellers</div>
                            <ul class="clearfix">
                                <li class="active">Top 20</li>

                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>

                        <div class="bestsellers_panel panel active">

                            <!-- Best Sellers Slider -->

                            <div class="bestsellers_slider slider">

                                <!-- Best Sellers Item -->

                                @foreach ($bestRateds as $bestRated)

                                    @php
                                        if ($bestRated->discount != null) {
                                            $newPrice = $bestRated->price - $bestRated->price * ($bestRated->discount / 100);
                                        }
                                    @endphp
                                    <div class="bestsellers_item discount">
                                        <div
                                            class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                            <div class="bestsellers_image">
                                                <img src="{{ asset("uploads/$bestRated->image_one") }}" alt="">
                                            </div>
                                            <div class="bestsellers_content">
                                                <div class="bestsellers_category"><a
                                                        href="#">{{ $bestRated->category->name }}</a></div>
                                                <div class="bestsellers_name"><a
                                                        href="product.html">{{ $bestRated->name }}</a>
                                                </div>
                                                <div class="rating_r rating_r_4 bestsellers_rating">
                                                    <i></i><i></i><i></i><i></i><i></i>
                                                </div>
                                                @if ($bestRated->discount != null)
                                                    <div class="bestsellers_price discount">
                                                        $ {{ $newPrice }}<span>$
                                                            {{ $bestRated->price }}</span>
                                                    </div>
                                                @else
                                                    <div class="bestsellers_price discount">
                                                        $ {{ $bestRated->price }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="bestsellers_fav active"><i class="fas fa-heart"></i></div>
                                        <ul class="bestsellers_marks">
                                            @if ($bestRated->discount != null)
                                                <li class="bestsellers_mark bestsellers_discount">
                                                    -{{ $bestRated->discount }}%
                                                </li>
                                            @else
                                                <li class="bestsellers_mark bestsellers_discount" style="background:blue;">
                                                    New</li>
                                            @endif

                                        </ul>



                                    </div>

                                @endforeach


                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Adverts -->
    {{-- <div class="adverts">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 advert_col">

                    <!-- Advert Item -->

                    <div class="advert d-flex flex-row align-items-center justify-content-start">
                        <div class="advert_content">
                            <div class="advert_title"><a href="#">Trends 2018</a></div>
                            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</div>
                        </div>
                        <div class="ml-auto">
                            <div class="advert_image"><img src="{{ asset('web/images/adv_1.png') }}" alt=""></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 advert_col">

                    <!-- Advert Item -->

                    <div class="advert d-flex flex-row align-items-center justify-content-start">
                        <div class="advert_content">
                            <div class="advert_subtitle">Trends 2018</div>
                            <div class="advert_title_2"><a href="#">Sale -45%</a></div>
                            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
                        </div>
                        <div class="ml-auto">
                            <div class="advert_image"><img src="{{ asset('web/images/adv_2.png') }}" alt=""></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 advert_col">

                    <!-- Advert Item -->

                    <div class="advert d-flex flex-row align-items-center justify-content-start">
                        <div class="advert_content">
                            <div class="advert_title"><a href="#">Trends 2018</a></div>
                            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
                        </div>
                        <div class="ml-auto">
                            <div class="advert_image"><img src="{{ asset('web/images/adv_3.png') }}" alt=""></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}

    <!-- Buy One Get One -->

    <div class="trends">
        <div class="trends_background" style="background-image:url({{ asset('web/images/trends_background.jpg') }})">
        </div>
        <div class="trends_overlay"></div>
        <div class="container">
            <div class="row">

                <!-- Trends Content -->
                <div class="col-lg-3">
                    <div class="trends_container">
                        <h2 class="trends_title">Buy One Get One</h2>
                        <div class="trends_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</p>
                        </div>
                        <div class="trends_slider_nav">
                            <div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                            <div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Trends Slider -->
                <div class="col-lg-9">
                    <div class="trends_slider_container">

                        <!-- Trends Slider -->

                        <div class="owl-carousel owl-theme trends_slider">

                            <!-- Trends Slider Item -->
                            @foreach ($buyone_getone as $product)
                                <div class="owl-item">
                                    <div class="trends_item">
                                        <div
                                            class="trends_image d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{ asset("uploads/$product->image_one") }}" alt=""
                                                style="height:120px; width:100px;">
                                        </div>
                                        <div class="trends_content">
                                            <div class="trends_category"><a href="#">{{ $product->brand->name }}</a>
                                            </div>
                                            <div class="trends_info clearfix">
                                                <div class="trends_name"><a
                                                        href="{{ url("web/product/details/$product->id") }}">{{ $product->name }}</a>
                                                </div>
                                                <div class="trends_price">{{ $product->price }}</div>
                                            </div>
                                            <button class="btn btn-danger btn-sm addcart" data-id={{ $product->id }}>Add
                                                To Cart</button>
                                        </div>
                                        <button class="addwishlist" data-id={{ $product->id }}>
                                            <div class="trends_fav"><i class="fas fa-heart"></i></div>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Reviews -->

    <div class="reviews">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="reviews_title_container">
                        <h3 class="reviews_title">Latest Reviews</h3>
                        <div class="reviews_all ml-auto"><a href="#">view all <span>reviews</span></a></div>
                    </div>

                    <div class="reviews_slider_container">

                        <!-- Reviews Slider -->
                        <div class="owl-carousel owl-theme reviews_slider">

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="{{ asset('web/images/review_1.jpg') }} "
                                                alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Roberto Sanchez</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i>
                                            </div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="{{ asset('web/images/review_2.jpg') }} "
                                                alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Brandon Flowers</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i>
                                            </div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="{{ asset('web/images/review_3.jpg') }} "
                                                alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Emilia Clarke</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i>
                                            </div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="{{ asset('web/images/review_1.jpg') }} "
                                                alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Roberto Sanchez</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i>
                                            </div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="{{ asset('web/images/review_2.jpg') }} "
                                                alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Brandon Flowers</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i>
                                            </div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="{{ asset('web/images/review_3.jpg') }} "
                                                alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Emilia Clarke</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i>
                                            </div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="reviews_dots"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recently Viewed -->

    {{-- <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Recently Viewed</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="{{ asset('web/images/view_1.jpg') }} " alt="">
                                    </div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$225<span>$300</span></div>
                                        <div class="viewed_name"><a href="#">Beoplay H7</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="{{ asset('web/images/view_2.jpg') }} " alt="">
                                    </div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$379</div>
                                        <div class="viewed_name"><a href="#">LUNA Smartphone</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="{{ asset('web/images/view_3.jpg') }} " alt="">
                                    </div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$225</div>
                                        <div class="viewed_name"><a href="#">Samsung J730F...</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="{{ asset('web/images/view_4.jpg') }} " alt="">
                                    </div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$379</div>
                                        <div class="viewed_name"><a href="#">Huawei MediaPad...</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="{{ asset('web/images/view_5.jpg') }} " alt="">
                                    </div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$225<span>$300</span></div>
                                        <div class="viewed_name"><a href="#">Sony PS4 Slim</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="{{ asset('web/images/view_6.jpg') }} " alt="">
                                    </div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$375</div>
                                        <div class="viewed_name"><a href="#">Speedlink...</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Brands -->

    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brands_slider_container">

                        <!-- Brands Slider -->

                        <div class="owl-carousel owl-theme brands_slider">
                            @foreach ($brands as $brand)
                                <div class="owl-item">
                                    <div class="brands_item d-flex flex-column justify-content-center"><img
                                            src="{{ asset("uploads/$brand->logo") }} " style="width:70px; height:60px;">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div
                        class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon"><img src="{{ asset('web/images/send.png') }}" alt=""></div>
                            <div class="newsletter_title">Sign up for Newsletter</div>
                            <div class="newsletter_text">
                                <p>...and receive %20 coupon for first shopping.</p>
                            </div>
                        </div>
                        <div class="newsletter_content clearfix">
                            <form action="{{ route('store.newsletter') }}" method="POST" class="newsletter_form">
                                @csrf
                                <input type="email" name="email" class="newsletter_input" required="required"
                                    placeholder="Enter your email address">
                                <button class="newsletter_button" type="submit">Subscribe</button>
                            </form>
                            <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLevel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Quick View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="" id="product_img" style="width:200px; height:220px;">
                                    <div class="card-body">
                                        <div class="card-title text-center" id="product_name"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <ul class="list-group">
                                    <li class="list-group-item">Code : <span id="product_code"></span></li>
                                    <li class="list-group-item" id="">Category : <span id="product_cat"></span></li>
                                    <li class="list-group-item" id="">SubCategory : <span id="product_subcat"></span></li>
                                    <li class="list-group-item" id="">Brand : <span id="product_brand"></span></li>
                                    <li class="list-group-item">Stock : <span class="badge"
                                            style="background: green; color:white;">Available</span></li>
                                </ul>
                            </div>

                            <div class="col-md-4">
                                <form action="{{ route('insert.modal.data') }}" method="post"
                                    enctype="multipart/form-data">

                                    @csrf
                                    <input type="hidden" name="productIid" id="product_id">
                                    <div class="form-group">
                                        <label for="exampleFormcontrolSelect1">Color</label>
                                        <select class="form-control" id="color" name="productColor">

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormcontrolSelect1">Size</label>
                                        <select class="form-control" id="size" name="productSize">

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormcontrolSelect1">Quantity</label>
                                        <input class="form-control" id="quantity_input" type="number" name="qty"
                                            pattern="[0-9]*" value="1" style="width:70px;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add To
                                            Cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        function productview(id) {
            var url = "{{ asset('uploads') }}"
            $.ajax({
                url: "{{ url('web/product/modal/view/') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#product_id').val(data.product.id);

                    $('#product_name').text(data.product.name);
                    $('#product_code').text(data.product.code);
                    $('#product_cat').text(data.product_cat.name);
                    $('#product_subcat').text(data.product_subcat.name);
                    $('#product_brand').text(data.product_brand.name);
                    // $('#product_img').attr('src', data.product.image_one);
                    $('#product_img').attr('src', data.url + product.image_one);



                    var color = $('select[name="productColor"]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="productColor"]').append('<option value="' + value + '">' +
                            value +
                            '</option>');
                    });

                    var size = $('select[name="productSize"]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="productSize"]').append('<option value="' + value + '">' +
                            value +
                            '</option>');
                    });


                }
            });
        }

    </script>
@endsection
