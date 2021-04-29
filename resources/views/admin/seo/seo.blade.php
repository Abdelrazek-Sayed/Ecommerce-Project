@extends('admin.layout.admin_master')

@section('content')
    <div class="container">

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Seo Setting
                </h6>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <form method="post" action="{{ route('update.seo',$seo->id) }}">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Title</label>
                                    <input class="form-control" type="text" name="meta_title" value="{{ $seo->meta_title }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Auther</label>
                                    <input class="form-control" type="text" name="meta_auther" value="{{ $seo->meta_auther }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Tag</label>
                                    <input class="form-control" type="text" name="meta_tag" value="{{ $seo->meta_tag }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Description</label>
                                    <textarea class="form-control summernote" name="meta_description" cols="30"
                                        rows="3">{{ $seo->meta_description }}</textarea>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Google</label>
                                    <textarea class="form-control summernote" name="google_analytics" cols="30"
                                        rows="3">{{ $seo->google_analytics }}</textarea>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Bing</label>
                                    <textarea class="form-control summernote" name="bing_analytics" cols="30"
                                        rows="3">{{ $seo->bing_analytics }}</textarea>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-info pd-x-20">Update</button>
                            </div><!-- col-4 -->

                        </div><!-- form-layout -->
                </form>
            </div><!-- card -->
        </div>
    </div>

@endsection
