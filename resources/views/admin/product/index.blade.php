@extends('admin.layout.admin_master')

@section('content')
    <div class="container">
        {{-- <div class="sl-mainpanel"> --}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Product</h5>
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
                        Product List
                        <a href="{{ route('add.product') }}" class="btn btn-sm btn-warning" style="float: right;">Add
                            Product</a>
                    </h6>
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">Code</th>
                                    <th scope="col" width="5%">Name</th>
                                    <th scope="col" width="10%">Image</th>
                                    <th scope="col" width="5%">Category</th>
                                    <th scope="col" width="5%">Brand</th>
                                    <th scope="col" width="5%">Quantity</th>
                                    {{--  <th scope="col" width="5%">Price</th>  --}}
                                    <th scope="col" width="5%">Status</th>
                                    <th scope="col" width="25%">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <img src="{{ URL::to("uploads/$product->image_one") }}" height="50px">
                                        </td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->brand->name }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        {{--  <td>{{ $product->price }}</td>  --}}
                                        <td>
                                            @if ($product->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @elseif($product->status == 0)
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <a href="{{ url("admin/dashboard/product/edit/$product->id") }}"
                                                    class="btn btn-success" title="edit"><i class="fa fa-edit"></i></a>
                                                <a href="{{ url("admin/dashboard/product/delete/$product->id") }}"
                                                    id="delete" class="btn btn-danger" title="delete"><i
                                                        class="fa fa-trash"></i></a>
                                                <a href="{{ url("admin/dashboard/product/show/$product->id") }}"
                                                    class="btn btn-info" title="show"><i class="fa fa-eye"></i></a>

                                                @if ($product->status == 0)
                                                    <a href="{{ url("admin/dashboard/product/toggle/$product->id") }}"
                                                        class="btn btn-primary" title="active"><i
                                                            class="fa fa-thumbs-up"></i></a>

                                                @elseif($product->status == 1)
                                                    <a href="{{ url("admin/dashboard/product/toggle/$product->id") }}"
                                                        class="btn btn-warning" title="inactive"><i
                                                            class="fa fa-thumbs-down"></i></a>

                                                @endif
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
@endsection
