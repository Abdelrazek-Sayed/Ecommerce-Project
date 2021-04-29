@extends('admin.layout.admin_master')
@section('title')
    Admin profile
@endsection

@section('content')

    <div class="container py-5">

        <div class="card" style="width: 18rem;">
            <img src="{{ !empty($admin->profile_photo_path) ? url("uploads/$admin->profile_photo_path") : url('uploads/no_image.jpg') }}"
                class="card-img-top">

            <div class="card-body">
                <h5 class="card-title">{{ $admin->name }}</h5>
                <p class="card-text">{{ $admin->email }}</p>
                <a href="{{ route('admin.edit.profile') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>

    </div>


@endsection
