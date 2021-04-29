@extends('web.layout')

@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/blog_single_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/blog_single_responsive.css') }}">

@endsection



@section('content')

@include('web.includes.menu_bar')
    <!-- Single Blog Post -->

    <div class="single_post">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    @if (App::getlocale() == 'en')
                        <div class="single_post_title">{{ $post->title_en }}</div>
                    @else
                        <div class="single_post_title">{{ $post->title_ar }}</div>
                    @endif
                    <div class="single_post_text">

                        @if (App::getlocale() == 'en')
                            <p>{!! $post->details_en !!}</p>
                        @else
                            <p>{!! $post->details_ar !!}</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Posts -->
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
    <script src="{{ asset('web/plugins/parallax-js-master/parallax.min.js') }}"></script>
    <script src="{{ asset('web/plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('web/js/blog_single_custom.js') }}"></script>
@endsection
