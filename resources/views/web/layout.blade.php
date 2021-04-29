<!DOCTYPE html>
<html lang="en">

<head>
    <title>OneTech</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/bootstrap4/bootstrap.min.css') }} ">
    <link href="{{ asset('web/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }} " rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }} ">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('web/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/plugins/OwlCarousel2-2.2.1/animate.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/plugins/slick-1.8.0/slick.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/main_styles.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/responsive.css') }} ">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="sweetalert2.min.css">

    @yield('style')
</head>
@php
$setting = App\Models\SiteSetting::first();
@endphp
<body>
    <div class="super_container">
        <!-- Header -->
        <header class="header">
            <!-- Top Bar -->
            <div class="top_bar">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex flex-row">
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon"><img src="{{ asset('web/images/phone.png') }}" alt=""></div>
                                {{ $setting->phone_one }}
                            </div>
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon"><img src="{{ asset('web/images/mail.png') }}" alt=""></div>
                                <a href="mailto:{{ $setting->email }}"> {{ $setting->email }}</a>
                            </div>
                            <div class="top_bar_content ml-auto">
                                <div class="top_bar_menu">
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        <li>
                                            {{-- @if (App::getlocale() == 'ar') --}}
                                            @if (Session::get('lang') == 'ar')
                                                <a href="{{ url('web/lang/en') }}">English<i
                                                        class="fas fa-chevron-down"></i></a>
                                            @else
                                                <a href="{{ url('web/lang/ar') }}">عربي<i
                                                        class="fas fa-chevron-down"></i></a>
                                            @endif
                                        </li>
                                        @auth
                                            <li>
                                                <div><a href="{{ route('user.profile') }}" data-toggle="modal"
                                                        data-target="#trackModal">Track the Order</a></div>
                                            </li>
                                            <li>
                                                <div><a href="{{ route('user.profile') }}">Profile</a></div>
                                                <ul>
                                                    <li><a href="{{ route('user.wishlist') }}">Wishlist</a></li>
                                                    <li><a href="{{ route('user.checkout') }}">Checkout</a></li>
                                                    <li><a href="#">Other</a></li>
                                                </ul>
                                            </li>
                                            {{-- @endif --}}
                                        @endauth
                                    </ul>
                                </div>
                                <div class="top_bar_user">
                                    @guest
                                        <div class="user_icon"><img src="{{ asset('web/images/user.svg') }} " alt="">
                                        </div>
                                        <div><a href="{{ route('login') }}">Register/Sign in</a></div>
                                    @endguest
                                    @auth
                                        <div><a href="{{ route('user.logout') }}">Sign Out</a></div>

                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Main -->

            <div class="header_main">
                <div class="container">
                    <div class="row">

                        <!-- Logo -->
                        <div class="col-lg-2 col-sm-3 col-3 order-1">
                            <div class="logo_container">
                                <div class="logo"><a href="{{ route('main.home.page') }}"><img
                                            src="{{ asset('web/images/logo.png') }}" alt=""></a></div>
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                            <div class="header_search">
                                <div class="header_search_content">
                                    <div class="header_search_form_container">
                                        <form method="POST" action="{{ route('product.search') }}" class="header_search_form clearfix">
                                                @csrf
                           
                                            <input type="search" required="required" class="header_search_input"
                                                placeholder="Search for products..."  name="search">
                                            <div class="custom_dropdown">
                                                <div class="custom_dropdown_list">
                                                    <span class="custom_dropdown_placeholder clc">All Categories</span>
                                                    <i class="fas fa-chevron-down"></i>
                                                    <ul class="custom_list clc">
                                                        @php
                                                            $cats = App\Models\Category::get();
                                                        @endphp
                                                        @foreach ($cats as $cat)
                                                            <li><a class="clc" href="#">{{ $cat->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <button type="submit" class="header_search_button trans_300"
                                                value="Submit"><img src="{{ asset('web/images/search.png') }}"
                                                    alt=""></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist -->
                        <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                            <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                                <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                    @auth
                                        @php
                                            $wishlists = App\Models\WishList::where('user_id', auth()->user()->id)->get();
                                        @endphp
                                        <div class="wishlist_icon"><img src="{{ asset('web/images/heart.png') }}" alt="">
                                            <div class="cart_count"><span>{{ count($wishlists) }}</span></div>
                                        </div>
                                        <div class="wishlist_content">
                                            <div class="wishlist_text"><a
                                                    href="{{ route('user.wishlist') }}">Wishlist</a></div>
                                        </div>
                                    @endauth
                                </div>

                                <!-- Cart -->
                                <div class="cart">
                                    <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                        <div class="cart_icon">
                                            <img src="{{ asset('web/images/cart.png') }}" alt="">
                                            <div class="cart_count"><span>{{ Cart::count() }}</span></div>
                                        </div>
                                        <div class="cart_content">
                                            <div class="cart_text"><a href="{{ route('cart.show') }}">Cart</a></div>
                                            <div class="cart_price">${{ Cart::subtotal() }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

            <!-- Footer -->

            <footer class="footer">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 footer_col">
                            <div class="footer_column footer_contact">
                                <div class="logo_container">
                                    <h3> {{ $setting->company_name }}</h3>
                                </div>
                                <div class="footer_title">Got Question? Call Us 24/7</div>
                                <div class="footer_phone"> {{ $setting->phone_one }}</div>
                                <div class="footer_contact_text">
                                    <p> {{ $setting->company_address }}</p>

                                </div>
                                <div class="footer_social">
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google"></i></a></li>
                                        <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 offset-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">Find it Fast</div>
                                <ul class="footer_list">
                                    <li><a href="#">Computers & Laptops</a></li>
                                    <li><a href="#">Cameras & Photos</a></li>
                                    <li><a href="#">Hardware</a></li>
                                    <li><a href="#">Smartphones & Tablets</a></li>
                                    <li><a href="#">TV & Audio</a></li>
                                </ul>
                                <div class="footer_subtitle">Gadgets</div>
                                <ul class="footer_list">
                                    <li><a href="#">Car Electronics</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="footer_column">
                                <ul class="footer_list footer_list_2">
                                    <li><a href="#">Video Games & Consoles</a></li>
                                    <li><a href="#">Accessories</a></li>
                                    <li><a href="#">Cameras & Photos</a></li>
                                    <li><a href="#">Hardware</a></li>
                                    <li><a href="#">Computers & Laptops</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">Customer Care</div>
                                <ul class="footer_list">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Order Tracking</a></li>
                                    <li><a href="#">Wish List</a></li>
                                    <li><a href="#">Customer Services</a></li>
                                    <li><a href="#">Returns / Exchange</a></li>
                                    <li><a href="#">FAQs</a></li>
                                    <li><a href="#">Product Support</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </footer>

            <!-- Copyright -->

            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <div
                                class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                                <div class="copyright_content">
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());

                                    </script> All rights reserved | This template is made with <i class="fa fa-heart"
                                        aria-hidden="true"></i> by <a href="https://colorlib.com"
                                        target="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </div>
                                <div class="logos ml-sm-auto">
                                    <ul class="logos_list">
                                        <li><a href="#"><img src="{{ asset('web/images/logos_1.png') }}" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{ asset('web/images/logos_2.png') }}" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{ asset('web/images/logos_3.png') }}" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{ asset('web/images/logos_4.png') }}" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('web/js/jquery-3.3.1.min.js') }} "></script>
    <script src="{{ asset('web/styles/bootstrap4/popper.js') }} "></script>
    <script src="{{ asset('web/styles/bootstrap4/bootstrap.min.js') }} "></script>
    <script src="{{ asset('web/plugins/greensock/TweenMax.min.js') }} "></script>
    <script src="{{ asset('web/plugins/greensock/TimelineMax.min.js') }} "></script>
    <script src="{{ asset('web/plugins/scrollmagic/ScrollMagic.min.js') }} "></script>
    <script src="{{ asset('web/plugins/greensock/animation.gsap.min.js') }} "></script>
    <script src="{{ asset('web/plugins/greensock/ScrollToPlugin.min.js') }} "></script>
    <script src="{{ asset('web/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }} "></script>
    <script src="{{ asset('web/plugins/slick-1.8.0/slick.js') }} "></script>
    <script src="{{ asset('web/plugins/easing/easing.js') }} "></script>
    <script src="{{ asset('web/js/custom.js') }} "></script>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"

            switch(type){
            case 'info' :
            toastr.info("{{ Session::get('message') }}");
            break;

            case 'success' :
            toastr.success("{{ Session::get('message') }}");
            break;

            case 'error' :
            toastr.error("{{ Session::get('message') }}");
            break;

            case 'warning' :
            toastr.warning("{{ Session::get('message') }}");
            break;
            }
        @endif

    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.addwishlist').on("click", function() {
                var id = $(this).data('id');
                if (id) {
                    $.ajax({
                        url: "{{ url('web/wishlist/') }}/" + id,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })
                            if ($.isEmptyObject(data.error)) {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.success
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: data.error
                                })
                            }

                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });

    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.addcart').on("click", function() {
                var id = $(this).data('id');
                if (id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('web/add/to/cart/') }}/" + id,
                        dataType: "JSON",
                        success: function(data) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })
                            if ($.isEmptyObject(data.error)) {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.success
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: data.error
                                })
                            }

                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });

    </script>


    @yield('script')




    <!-- Order Tracking Modal -->
    <div class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('order.track') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <label for="">Status Code</label>
                            <input type="text" name="status_code" required class="form-control" placeholder="Enter Status Code" >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Go</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
