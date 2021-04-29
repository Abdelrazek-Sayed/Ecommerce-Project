@extends('admin.layout.admin_master')

@section('content')
    <div class="container">
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <form method="POST" action="{{ route('update.setting') }}">
                    @csrf
                    <input type="hidden" name="setting_id" value="{{ $setting->id }}">
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Phone One</label>
                                    <input class="form-control" type="text" name="phone_one"
                                        value="{{ $setting->phone_one }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Phone Two</label>
                                    <input class="form-control" type="text" name="phone_two"
                                        value="{{ $setting->phone_two }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{ $setting->email }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Company Name</label>
                                    <input class="form-control" type="text" name="company_name"
                                        value="{{ $setting->company_name }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Company Address</label>
                                    <input class="form-control" type="text" name="company_address"
                                        value="{{ $setting->company_address }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Facbook</label>
                                    <input class="form-control" type="text" name="facebook"
                                    value="{{ $setting->facebook }}">

                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">YouTube</label>
                                    <input class="form-control" type="text" name="youtube"
                                        value="{{ $setting->youtube }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Twitter</label>
                                    <input class="form-control" type="text" name="twitter"
                                        value="{{ $setting->twitter }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Instagram</label>
                                    <input class="form-control" type="text" name="instagram"
                                        value="{{ $setting->instagram }}">
                                </div>
                            </div><!-- col-4 -->



                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5" type="submit">Update</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->
        </div>
    </div>





@endsection
