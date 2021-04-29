@extends('web.layout')

@section('style')

<link href="{{ asset("web/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css") }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset("web/plugins/OwlCarousel2-2.2.1/owl.carousel.css") }}">
<link rel="stylesheet" type="text/css" href="{{ asset("web/plugins/OwlCarousel2-2.2.1/owl.theme.default.css") }}">
<link rel="stylesheet" type="text/css" href="{{ asset("web/plugins/OwlCarousel2-2.2.1/animate.css") }}">
<link rel="stylesheet" type="text/css" href="{{ asset("web/styles/blog_styles.css") }}">
<link rel="stylesheet" type="text/css" href="{{ asset("web/styles/blog_responsive.css") }}">
@endsection



@section('content')
@include('web.includes.menu_bar')

<!-- Blog -->

<div class="blog">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="blog_posts d-flex flex-row align-items-start justify-content-between">

                    <!-- Blog post -->
                    @foreach ($posts as $post)

                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{ asset("uploads/$post->image") }})"></div>

                        @if (Session::get('lang') == 'ar')
                        <div class="blog_text">{{ $post->title_ar }}</div>
                        @else
                        <div class="blog_text">{{ $post->title_en }}</div>
                        @endif


                        @if (App::getlocale() == 'ar')
                        <div class="blog_button"><a href="{{  url("web/blog/post/$post->id") }}">متابعة القراءة </a></div>
                        @else
                        <div class="blog_button"><a href="{{ url("web/blog/post/$post->id") }}">Continue Reading</a></div>
                        @endif
                    </div>
                    @endforeach


                </div>
            </div>

        </div>
    </div>
</div>


@endsection



@section('script')


<script src="{{ asset("web/js/jquery-3.3.1.min.js") }}"></script>
<script src="{{ asset("web/styles/bootstrap4/popper.js") }}"></script>
<script src="{{ asset("web/styles/bootstrap4/bootstrap.min.js") }}"></script>
<script src="{{ asset("web/plugins/greensock/TweenMax.min.js") }}"></script>
<script src="{{ asset("web/plugins/greensock/TimelineMax.min.js") }}"></script>
<script src="{{ asset("web/plugins/scrollmagic/ScrollMagic.min.js") }}"></script>
<script src="{{ asset("web/plugins/greensock/animation.gsap.min.js") }}"></script>
<script src="{{ asset("web/plugins/greensock/ScrollToPlugin.min.js") }}"></script>
<script src="{{ asset("web/plugins/OwlCarousel2-2.2.1/owl.carousel.js") }}"></script>
<script src="{{ asset("web/plugins/parallax-js-master/parallax.min.js") }}"></script>
<script src="{{ asset("web/plugins/easing/easing.js") }}"></script>
<script src="{{ asset("web/js/blog_custom.js") }}"></script>

@endsection
