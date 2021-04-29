@extends('web.layout')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4> Update Password</h4>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('user.update.password') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" id="current_password" name="oldpassword" class="form-control">

                                @error('old_password')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input id="password" type="password" name="password" class="form-control">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    class="form-control">
                                @error('password_confirmation')
                                    {{ $message }}
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="mb-3 py-3">
                        <img src="{{ !empty($user->image) ? url("uploads/$user->image") : url('uploads/no_image.jpg') }}"
                            class="card-img-top" style="height: 120px; width:120px; margin-left:34%;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $user->name }}</h5>
                        <p class="card-text text-center">{{ $user->email }}</p>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="{{ route('user.edit.password') }}"><span><i
                                            class="fas fa-cogs"></i></span> Password Change</a></li>
                            <li class="list-group-item"><a href="{{ route('user.edit.profile') }}"><i
                                        class="fas fa-cogs"></i> Edit Profile</a></li>
                            <li class="btn btn-danger btn-sm btn-block"> <a href="{{ route('user.logout') }}">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
