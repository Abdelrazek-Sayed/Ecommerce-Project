@extends('admin.layout.admin_master')

@section('content')
    <div class="container">

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Add New Admin
                    <a href="{{ route('all.admin') }}" class="btn btn-success" style="float:right;">All Admins</a>
                </h6>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <form method="post" action="{{ route('update.admin', $admin->id) }}">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{ $admin->name }}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{ $admin->email }}">
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Role</label>
                                    <select class="form-control select2" name="role">
                                        <option label="choose Role" value=""></option>
                                        @foreach ($roles as $role)
                                            <option @if ($admin->roleName->name == $role->name) selected @endif value="{{ $role->id }}">
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->


                        </div><!-- row -->
                        <hr>
                        <br><br>


                        <div class="row">
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="data" value="1" @if ($admin->data == 1) checked @endif>
                                    <span>Data</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="copoun" value="1" @if ($admin->data == 1) checked @endif>
                                    <span>Copoun</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="newsletters" value="1" @if ($admin->newsletters == 1) checked @endif>
                                    <span>Newsletter</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="product" value="1" @if ($admin->product == 1) checked @endif>
                                    <span>Product</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="blog" value="1" @if ($admin->blog == 1) checked @endif>
                                    <span>Blog</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="orders" value="1" @if ($admin->orders == 1) checked @endif>
                                    <span>Orders</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="report" value="1" @if ($admin->report == 1) checked @endif>
                                    <span>Report</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="others" value="1" @if ($admin->others == 1) checked @endif>
                                    <span>Others</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="return" value="1" @if ($admin->return == 1) checked @endif>
                                    <span>Return</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="contact" value="1" @if ($admin->contact == 1) checked @endif>
                                    <span>Contact</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="setting" value="1" @if ($admin->setting == 1) checked @endif>
                                    <span>Setting</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="comment" value="1" @if ($admin->comment == 1) checked @endif>
                                    <span>Comment</span>
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="stock" value="1" @if ($admin->stock == 1) checked @endif>
                                    <span>Stock</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5" type="submit">Edit</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->
        </div>
    </div>

@endsection
