@extends('admin.layout.admin_master')
@section('content')
    <div class="container">
        {{-- <div class="sl-mainpanel"> --}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Coupon</h5>
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
                        <form method="POST" action="{{ url("admin/dashboard/coupon/update/$coupon->id") }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Coupon Code</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="coupon" value="{{ $coupon->coupon }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Coupon Discount</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="discount" value="{{ $coupon->discount }}">
                            </div>
                            <button type="submit" class="btn btn-info pd-x-20">Update</button>
                        </form>
                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div><!-- sl-pagebody -->
        </div><!-- sl-mainpanel -->
    </div><!-- container -->
@endsection
