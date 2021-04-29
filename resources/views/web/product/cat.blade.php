@extends('web.layout')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/shop_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/shop_responsive.css') }}">
@endsection


@section('content')
@include('web.includes.menu_bar')

    <div class="home">
        <div class="home_overlay"></div>
        <div class="home_content d-flex flex-column align-items-center justify-content-center">
            <h2 class="home_title">{{ $cat->name }}</h2>
        </div>
    </div>

    <!-- Shop -->

    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">

                    <!-- Shop Sidebar -->
                    <div class="shop_sidebar">
                        <div class="sidebar_section">
                            <div class="sidebar_title">Categories</div>
                            <ul class="sidebar_categories">
                                @foreach ($cats as $cat)
                                    <li><a href="{{ url("web/cat/page/$cat->id") }}">{{ $cat->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>


                        <div class="sidebar_section">
                            <div class="sidebar_subtitle brands_subtitle">Brands</div>
                            <ul class="brands_list">
                                @foreach ($brands as $brand)
                                    @php
                                        $brand = App\Models\Brand::where('id', $brand->brand_id)->first();
                                    @endphp
                                    <li class="brand"><a href="#">{{ $brand->name }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-lg-9">

                    <!-- Shop Content -->

                    <div class="shop_content">
                        <div class="shop_bar clearfix">
                            <div class="shop_product_count"><span>{{ count($products) }}</span> products found</div>
                            <div class="shop_sorting">
                                <span>Sort by:</span>
                                <ul>
                                    <li>
                                        <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                        <ul>
                                            <li class="shop_sorting_button"
                                                data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                            <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name
                                            </li>
                                            <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "price" }'>
                                                price</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product_grid row">
                            <div class="product_grid_border"></div>
                            @foreach ($products as $product)
                                @php
                                    if ($product->discount != null) {
                                        $newPrice = $product->price - $product->price * ($product->discount / 100);
                                    }
                                @endphp

                                <!-- Product Item -->
                                <div class="product_item is_new">
                                    <div class="product_border"></div>
                                    <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset("uploads/$product->image_one") }}"
                                            style="height:100px; width:100px;">
                                    </div>
                                    <div class="product_content">

                                        @if ($product->discount != null)
                                            <div class="product_price discount">
                                                {{ $newPrice }}<span>{{ $product->price }}</span></div>

                                        @else
                                            <div class="product_price">{{ $product->price }}</div>
                                        @endif
                                        <div class="product_name">
                                            <div><a
                                                    href="{{ url("web/product/details/$product->id") }}">{{ $product->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="addwishlist" data-id={{ $product->id }}>
                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                    </button>

                                    <ul class="product_marks">
                                        @if ($product->discount != null)
                                            <li class="product_mark product_discount" style="background:red;">
                                                -{{ $product->discount }}%
                                            </li>
                                        @else
                                            <li class="product_mark product_new" style="background:blue;">
                                                New</li>
                                        @endif
                                    </ul>
                                </div>
                            @endforeach



                        </div>

                        <!-- Shop Page Navigation -->

                        <div class="shop_page_nav d-flex flex-row">
                            {{--  {{ $products->links() }}  --}}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
