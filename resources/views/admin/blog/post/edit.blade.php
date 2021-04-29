@extends('admin.layout.admin_master')
@section('style')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@endsection
@section('content')
    <div class="container">

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Edit Post
                    <a href="{{ route('all.blogPost') }}" class="btn btn-success" style="float:right;">All Posts</a>
                </h6>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <form method="post" action="{{ url("admin/dashboard/blog/post/update/$post->id") }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Post English Title</label>
                                    <input class="form-control" type="text" name="title_en" value="{{ $post->title_en }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">العنوان باللغة العربية </label>
                                    <input class="form-control" type="text" name="title_ar" value="{{ $post->title_ar }}">
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Post English Details</label>
                                    <textarea class="form-control summernote" name="details_en" cols="30"
                                        rows="3">{{ $post->details_en }}</textarea>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">الوصف باللغة العربية</label>
                                    <textarea class="form-control summernote" name="details_ar" cols="30"
                                        rows="3">{{ $post->details_ar }}</textarea>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category</label>
                                    <select class="form-control select2" name="category_id">
                                        <option label="choose category" value=""></option>
                                        @foreach ($blogcats as $blogcat)
                                            <option @if ($blogcat->id == $post->category_id)  selected  @endif
                                                value="{{ $blogcat->id }}">{{ $blogcat->category_name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Image
                                        <span class="tx-danger">*</span>
                                    </label>
                                    <br>
                                    <label class="custom-file">
                                        <input type="file" id="file" name="image" class="custom-file-input"
                                            onchange="readURL(this);">
                                        <span class="custom-file-control"></span>
                                        <br><br><br>
                                        <img src="{{ asset("uploads/$post->image") }}" id="one" style="height:100px; width:200px;">
                                    </label>
                                </div>
                                <br><br><br>
                                <button type="submit" class="btn btn-info pd-x-20">Update</button>
                            </div><!-- col-4 -->

                        </div><!-- form-layout -->
                </form>
            </div><!-- card -->
        </div>
    </div>

@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });

    </script>

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endsection
