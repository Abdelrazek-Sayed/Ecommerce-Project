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
                    <h6 class="card-body-title">
                        Coupon List
                        <a class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal"
                            data-target="#modaldemo3">Add Coupon</a>
                    </h6>
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p text-center">serial</th>
                                    <th class="wd-15p text-center">Coupon Code</th>
                                    <th class="wd-15p text-center">Coupon Value</th>
                                    <th class="wd-20p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $coupon->coupon }}</td>
                                        <td class="text-center">{{ $coupon->discount }}</td>

                                        <td class="text-center">

                                                <div class="form-group">
                                                    <a class="btn btn-success btn-sm"
                                                        href="{{ url("admin/dashboard/coupon/edit/$coupon->id") }}">Edit
                                                    </a>
                                                    <a id="delete"
                                                        href="{{ url("admin/dashboard/coupon/delete/$coupon->id") }}"
                                                        class="btn btn-danger btn-sm">Delete</a>
                                                </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div><!-- sl-pagebody -->
        </div><!-- sl-mainpanel -->
    </div><!-- container -->


    <!-- LARGE MODAL -->
    <div id="modaldemo3" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Coupon</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <form method="POST" action="{{ route('admin.store.coupon') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Coupon Code</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="coupon">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Coupon Discount</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="discount">
                        </div>
                        <button type="submit" class="btn btn-info pd-x-20">Add</button>
                    </form>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection
