@extends('admin.layout.admin_master')
@section('title')
    Edit-password
@endsection



@section('content')

    <div class="container py-5">

        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4> Update Password</h4>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.update.password') }}">
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
        </div>
    </div>

@endsection
