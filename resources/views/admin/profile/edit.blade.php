@extends('admin.layout.admin_master')
@section('title')
    Edit-profile
@endsection

@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <form method="POST" action="{{ route('admin.update.profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $admin->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="{{ $admin->email }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="profile_photo_path" id="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <img src="{{ !empty($admin->profile_photo_path) ? url("uploads/adminImages/$admin->profile_photo_path") : url('uploads/no_image.jpg') }}"
                            style="height:100px; width:200px;" id="showImage">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>

    </div>

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
