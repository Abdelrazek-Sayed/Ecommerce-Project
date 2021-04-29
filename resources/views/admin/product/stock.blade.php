@extends('admin.layout.admin_master')

@section('content')
    <div class="container">

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
                                    <th scope="col" width="5%">Status</th>

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
                                        <td class="text-center">{{ $product->quantity }}</td>
                                        <td>
                                            @if ($product->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @elseif($product->status == 0)
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
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
