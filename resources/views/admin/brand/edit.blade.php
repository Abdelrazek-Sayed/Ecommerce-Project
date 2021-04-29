@extends('admin.layout.admin_master')

@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')
    <div class="container">
        {{-- <div class="sl-mainpanel"> --}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Cateory</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
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
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                        <form method="POST" action="{{ url("admin/dashboard/brand/update/$brand->id") }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" value="{{ $brand->name }}"
                                    aria-describedby="emailHelp" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Brand Logo</label>
                                <input type="file" class="form-control" name="logo" id="image">
                            </div>
                            <div class="mb-3">
                                <img src="{{ asset("uploads/$brand->logo") }}" style="height:100px; width:200px;"
                                    id="showImage">
                            </div>
                            <button type="submit" class="btn btn-info pd-x-20">Update</button>
                        </form>
                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div><!-- sl-pagebody -->
        </div><!-- sl-mainpanel -->
    </div><!-- container -->

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
