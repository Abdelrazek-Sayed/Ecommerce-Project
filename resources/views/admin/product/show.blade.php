@extends('admin.layout.admin_master')

@section('content')
    <div class="container">
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Name</label>
                                <br> <strong>{{ $product->name }}</strong>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Code</label>
                                <br> <strong>{{ $product->code }}</strong>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Quantity</label>
                                <br> <strong>{{ $product->quantity }}</strong>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Category</label>
                                <br> <strong>{{ $product->category->name }}</strong>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">SubCategory</label>
                                <br> <strong>{{ $product->subcat->name }}</strong>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Brand</label>
                                <br> <strong>{{ $product->brand->name }}</strong>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Size</label>
                                <br> <strong>{{ $product->size }}</strong>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Color</label>
                                <br> <strong>{{ $product->color }}</strong>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Price</label>
                                <br> <strong>{{ $product->price }}</strong>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Product Details</label>
                                <br>
                                <p>{!! $product->details !!}</p>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">video link</label>
                                <br> <strong>{{ $product->video_link }}</strong>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">First Image</label>
                                <br> <img src="{{ asset("uploads/$product->image_one") }}"
                                    style="height:80px; width:80px">
                            </div>

                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Second Image</label>
                                <br> <img src="{{ asset("uploads/$product->image_two") }}"
                                    style="height:80px; width:80px">
                            </div>

                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Third Image</label>
                                <br> <img src="{{ asset("uploads/$product->image_three") }}"
                                    style="height:80px; width:80px">
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <hr>
                    <br><br>
                    <div class="row">
                        <div class="col-lg-4">
                            <label>
                                <span>Main Slider : </span>
                                @if ($product->main_slider == 1)
                                    <span class="badge badge-success">yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label>
                                <span>Main Slider : </span>
                                @if ($product->mid_slider == 1)
                                    <span class="badge badge-success">yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label>
                                <span>Main Slider : </span>
                                @if ($product->hot_deal == 1)
                                    <span class="badge badge-success">yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label>
                                <span>Main Slider : </span>
                                @if ($product->trend == 1)
                                    <span class="badge badge-success">yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label>
                                <span>Main Slider : </span>
                                @if ($product->hot_new == 1)
                                    <span class="badge badge-success">yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label>
                                <span>Main Slider : </span>
                                @if ($product->best_rated == 1)
                                    <span class="badge badge-success">yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </label>
                        </div>
                    </div>

                </div><!-- card -->
            </div>
        </div>

    @endsection
