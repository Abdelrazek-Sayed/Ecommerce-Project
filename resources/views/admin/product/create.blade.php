@extends('admin.layout.admin_master')
@section('style')
    <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection
@section('content')
    <div class="container">

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Add New Product
                    <a href="{{ route('all.product') }}" class="btn btn-success" style="float:right;">All Products</a>
                </h6>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <form method="post" action="{{ route('store.product') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Name</label>
                                    <input class="form-control" type="text" name="name" value=""
                                        placeholder="Enter Product Name">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Code</label>
                                    <input class="form-control" type="text" name="code" value="" placeholder="Enter Code">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Quantity</label>
                                    <input class="form-control" type="text" name="quantity" value=""
                                        placeholder="Enter product Quantity">
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category</label>
                                    <select class="form-control select2" name="category_id">
                                        <option label="choose category" value=""></option>
                                        @foreach ($cats as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">SubCategory</label>
                                    <select class="form-control select2" name="subcategory_id">

                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Brand</label>
                                    <select class="form-control select2" name="brand_id" data-placeholder="Choose Brand">
                                        <option label="choose Brand" value=""></option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Product Price</label>
                                    <input class="form-control" type="text" name="price" placeholder="Enter product Price">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Product Discount</label>
                                    <input class="form-control" type="text" name="discount">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Product Size</label>
                                    <input class="form-control" type="text" name="size" id="size" data-role="tagsinput">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Product Color</label>
                                    <input class="form-control" type="text" name="color" id="color" data-role="tagsinput">
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Product Details</label>
                                    <textarea class="form-control" id="summernote" name="details"></textarea>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">video link</label>
                                    <input class="form-control" name="video_link" placeholder="Enter video link">
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">First Image (main thumbnail)
                                        <span class="tx-danger">*</span>
                                    </label>
                                    <label class="custom-file">
                                        <input type="file" id="file" name="image_one" class="custom-file-input"
                                            onchange="readURL(this);" required="">
                                        <span class="custom-file-control"></span>
                                        <img src="#" id="one">
                                    </label>
                                </div>

                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Second Image
                                        <span class="tx-danger">*</span>
                                    </label>
                                    <label class="custom-file">
                                        <input type="file" id="file" name="image_two" class="custom-file-input"
                                            onchange="readURL2(this);">
                                        <span class="custom-file-control"></span>
                                        <img src="#" id="two">
                                    </label>
                                </div>

                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Third Image
                                        <span class="tx-danger">*</span>
                                    </label>
                                    <label class="custom-file">
                                        <input type="file" id="file" name="image_three" class="custom-file-input"
                                            onchange="readURL3(this);">
                                        <span class="custom-file-control"></span>
                                        <img src="#" id="three">
                                    </label>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->
                        <hr>
                        <br><br>
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="main_slider" value="1">
                                    <span>Main Slider</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="mid_slider" value="1">
                                    <span>Mid Slider</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="hot_deal" value="1">
                                    <span>Hot Deals</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="trend" value="1">
                                    <span>Trend</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="hot_new" value="1">
                                    <span>Hot New</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="best_rated" value="1">
                                    <span>Best Rated</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="buyone_getone" value="1">
                                    <span>Buy One Get One</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5" type="submit">Add</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->
        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });

    </script>


    {{-- ajax --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {

                    $.ajax({
                        url: "{{ url('/admin/dashboard/product/get/subcategory/') }}/" +
                            category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {

                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                        },
                    });

                } else {
                    alert('danger');
                }

            });
        });

    </script>

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

    <script type="text/javascript">
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#two')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

    <script type="text/javascript">
        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#three')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endsection
