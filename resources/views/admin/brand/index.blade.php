@extends('admin.layout.admin_master')

@section('content')
    <div class="container">
        {{-- <div class="sl-mainpanel"> --}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Brand</h5>
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
                        Brand List
                        <a class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal"
                            data-target="#modaldemo3">Add Brand</a>
                    </h6>
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">Serial</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brands Logo</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                    @foreach ($brands as $brand)
                                        <tr>
                                            {{-- <th scope="row">{{ $brands->firstItem() + $loop->index }}</th> --}}
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $brand->name }}</td>
                                            <td>
                                                {{-- <img src="{{ asset("uploads/$brand->logo") }}" height="50px"> --}}
                                                <img src="{{ URL::to("uploads/$brand->logo") }}" height="50px">
                                            </td>
                                            <td>
                                                @if ($brand->created_at == null)
                                                    <span class="text-danger"> no date</span>
                                                @else
                                                    {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <a href="{{ url("admin/dashboard/brand/edit/$brand->id") }}"
                                                        class="btn btn-success">Edit</a>
                                                    <a href="{{ url("admin/dashboard/brand/delete/$brand->id") }}" id="delete"
                                                        class="btn btn-danger">Delete</a>
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
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Category</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pd-20">
                        <form method="POST" action="{{ route('admin.store.brand') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Category Logo</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="logo">
                            </div>
                            <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                            <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div><!-- modal-dialog -->
        </div><!-- modal -->
    @endsection
