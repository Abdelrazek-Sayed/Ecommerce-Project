@extends('web.layout')


@section('style')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <form method="POST" action="{{ url('user/update/profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <img src="{{ !empty($user->image) ? url("uploads/$user->image") : url('uploads/no_image.jpg') }}"
                            style="height:100px; width:200px;" id="showImage">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
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
                            <li class="btn btn-danger btn-sm btn-block"> <a
                                    href="{{ route('user.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result)
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>

@endsection
