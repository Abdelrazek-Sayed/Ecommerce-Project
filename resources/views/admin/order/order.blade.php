@extends('admin.layout.admin_master')


@section('content')
    <div class="container">
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="sl-page-title">
                                    <h5>Order</h5>
                                </div><!-- sl-page-title -->
                                <table class="table">
                                    <tr>
                                        <th>Name : </th>
                                        <th>{{ $order->user->name }}</th>
                                    </tr>
                                    <tr>
                                        <th>Phone : </th>
                                        <th>{{ $order->user->phone }}</th>
                                    </tr>
                                    <tr>
                                        <th>Payment Type : </th>
                                        <th>{{ $order->payment_type }}</th>
                                    </tr>
                                    <tr>
                                        <th>Payment ID : </th>
                                        <th>{{ $order->payment_id }}</th>
                                    </tr>
                                    <tr>
                                        <th>Total : </th>
                                        <th>{{ $order->total }}</th>
                                    </tr>
                                    <tr>
                                        <th>Month : </th>
                                        <th>{{ $order->month }}</th>
                                    </tr>
                                    <tr>
                                        <th>Date : </th>
                                        <th>{{ $order->date }}</th>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="sl-page-title">
                                    <h5>shipping</h5>
                                </div><!-- sl-page-title -->
                                <table class="table">
                                    <tr>
                                        <th>Name : </th>
                                        <th>{{ $shipping->ship_name }}</th>
                                    </tr>
                                    <tr>
                                        <th>Phone : </th>
                                        <th>{{ $shipping->ship_phone }}</th>
                                    </tr>
                                    <tr>
                                        <th>Email : </th>
                                        <th>{{ $shipping->ship_email }}</th>
                                    </tr>
                                    <tr>
                                        <th>Address : </th>
                                        <th>{{ $shipping->ship_address }}</th>
                                    </tr>
                                    <tr>
                                        <th>City : </th>
                                        <th>{{ $shipping->ship_city }}</th>
                                    </tr>
                                    <tr>
                                        <th>Status : </th>
                                        @if ($order->status == 0)
                                            <th> <span class="badge badge-warning">Pending</span></th>
                                        @elseif($order->status == 1)
                                            <th> <span class="badge badge-info">Payment Accept</span></th>
                                        @elseif($order->status == 2)
                                            <th> <span class="badge badge-primary">Progress</span></th>
                                        @elseif($order->status == 3)
                                            <th> <span class="badge badge-success">Delevered</span></th>
                                        @else
                                            <th><span class="badge badge-danger">Canceled</span></th>
                                        @endif

                                    </tr>

                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="sl-page-title">
                                    <h5>Details</h5>
                                </div><!-- sl-page-title -->
                                <table class="table text-center">
                                    <thead>
                                        <tr>

                                            <th scope="col">Image</th>
                                            <th scope="col">Product Code </th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Total price</th>
                                        </tr>
                                    </thead>
                                    @foreach ($details as $detail)
                                        <tbody class="text-center">
                                            <tr>
                                                <th scope="row">

                                                    <div class="cart_item_image">
                                                        <img src="{{ asset("uploads/$detail->image_one") }}"
                                                            style="width:70px; height:50px;">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="cart_item_text text-center">{{ $detail->code }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="cart_item_text text-center">{{ $detail->product_name }}
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="cart_item_text text-center">{{ $detail->color }}</div>

                                                </td>
                                                <td>
                                                    <div class="cart_item_text text-center">{{ $detail->size }}</div>
                                                </td>
                                                <td>
                                                    <div class="cart_item_text text-center">{{ $detail->qty }}</div>
                                                </td>
                                                <td>
                                                    <div class="cart_item_text text-center">{{ $detail->singleprice }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="cart_item_text text-center">{{ $detail->totalprice }}
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    @endforeach
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        @if ($order->status == 0)
                            <a href="{{ route('accept.order', $order->id) }}" class="btn btn-info">Payment Accept</a>
                            <a href="{{ route('cancel.order', $order->id) }}" class="btn btn-danger">Cancel</a>
                        @elseif ($order->status == 1)
                            <a href="{{ route('process.delivery', $order->id) }}" class="btn btn-warning">Process
                                Delivery</a>
                        @elseif ($order->status == 2)
                            <a href="{{ route('delivery.done', $order->id) }}" class="btn btn-success">Delivery Done</a>
                        @elseif ($order->status == 3)
                            <strong class="text-success text-center">This order successfully deliveried</strong>
                        @else
                            <strong class="text-danger">This order cancelled</strong>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
