@extends('web.layout')
@section('content')
    <div class="alert alert-success">
        A verification email sent successfully, please check your inbox
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="contact-form">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-warning">Resend Email</button>
                    </form>
                </div>
                <br><br>
                <div class="contact-form">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
