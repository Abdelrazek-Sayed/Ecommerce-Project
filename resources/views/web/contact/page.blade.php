@extends('web.layout')


@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('web/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/contact_responsive.css') }}">


@endsection

@section('content')


    <!-- Contact Info -->

    <div class="contact_info">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div
                        class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{ asset('web/images/contact_1.png') }}" alt="">
                            </div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Phone</div>
                                <div class="contact_info_text">{{ $setting->phone_one }}</div>
                            </div>
                        </div>

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{ asset('web/images/contact_2.png') }}" alt="">
                            </div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Email</div>
                                <div class="contact_info_text">{{ $setting->email }}</div>
                            </div>
                        </div>

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{ asset('web/images/contact_3.png') }}" alt="">
                            </div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Address</div>
                                <div class="contact_info_text">{{ $setting->company_address }}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form -->

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="contact_form_container">
                        <div class="contact_form_title">Get in Touch</div>

                        <form method="POST" action="{{ route('send.message') }}" id="contact_form">
                            @csrf
                            <div
                                class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                                <input type="text" id="contact_form_name" class="contact_form_name input_field" name="name"
                                    placeholder="Your name" required="required" data-error="Name is required.">
                                <input type="email" id="contact_form_email" class="contact_form_email input_field"
                                    name="email" placeholder="Your email" required="required"
                                    data-error="Email is required.">
                                <input type="text" id="contact_form_phone" class="contact_form_phone input_field"
                                    name="phone" placeholder="Your phone number">
                            </div>
                            <div class="contact_form_text">
                                <textarea id="contact_form_message" class="text_field contact_form_message" name="message"
                                    rows="4" placeholder="Message" required="required"
                                    data-error="Please, write us a message."></textarea>
                            </div>
                            <div class="contact_form_button">
                                <button type="submit" class="button contact_submit_button">Send Message</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="panel"></div>
    </div>

    <!-- Map -->

    <div class="contact_map">
        <div id="google_map" class="google_map">
            <div class="map_container">
                <div id="map"></div>
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
    <script src="{{ asset('web/plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('web/js/contact_custom.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
@endsection
