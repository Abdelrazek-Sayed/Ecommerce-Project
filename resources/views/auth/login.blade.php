@extends('web.layout')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/styles/contact_responsive.css') }}">


    <link rel="stylesheet" href="{{ asset('user/backend/panel/assets/css/all.min.css') }}">
@endsection
@section('content')
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
                <div class="col-lg-5 offset-lg-1" style="border: 1px solid grey; padding:20px; border-radius:25px;">
                    <h2 class="text-center">Sign In</h2>
                    <br>
                    <div class="form-group">

                        <form method="POST" action="{{ isset($guard) ? url($guard . '/login') : route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="password">Email</label>
                                <input class="form-control  type=" email" name="email" :value="old('email')" required
                                    autocomplete="email" autofocus placeholder="Email Address">

                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>

                                <input class="form-control   id=" password" type="password" name=" password" required
                                    autocomplete="current-password" placeholder="Password">

                            </div>
                            <div class="form-group">
                                <label class="chech_container">Remember me
                                    <input type="checkbox" name="remember" id="remember">
                                    <span class="checkmark"></span>
                                </label>
                                <a href="{{ url('/forgot-password') }}" class="text-black" style="float: right;">I forgot
                                    my password</a>
                                <br>
                                <button type="submit" class="btn btn-info">Login</button>
                            </div>
                        </form>
                        <br>
                        <div class="form-group">
                            <a type="submit" href="{{ url('auth/facebook') }}" class="btn btn-primary btn-block"> <i
                                    class="fa fa-facbook"></i> Login
                                with
                                Facbook</a>
                            <a href="{{ url('auth/google') }}" class="btn btn-danger btn-block"> <i
                                    class="fa fa-facbook"></i>Login with
                                Google</a>
                        </div>
                    </div>
                </div>
                @if (!isset($guard))
                    <div class="col-lg-5 offset-lg-1" style="border: 1px solid grey; padding:20px; border-radius:25px;">
                        <h2 class="text-center">Sign Up</h2>

                        <br>
                        <div class="form-group">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="uname">Name</label>
                                    <input id="name" type="text" class="form-control" placeholder="Full Name" name="name"
                                        autocomplete="name" autofocus value=" " required>

                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" value=" " required
                                        autocomplete="email" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required
                                        autocomplete="new-password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="rtpassword">Re-type Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Confirm Password">
                                </div>
                                <div class="form-group">

                                    <button type="submit" class="btn btn-info">Signup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="fb-like" data-share="true" data-width="450" data-show-faces="true">
    </div>
@endsection

