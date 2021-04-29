@extends('admin.layout.admin_master')


@section('content')


    <div class="container">
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>This year Income <span style="color: red;">{{ $sumtotal }} $</span></h5>
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
                    {{-- <h6 class="card-body-title">
                        Pending Orders
                    </h6> --}}
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                                <tr>

                                    <th class="text-center" width="5%">Payment</th>
                                    <th class="text-center">Transaction Id</th>
                                    <th class="text-center" width="5%">Subtotal</th>
                                    <th class="text-center" width="5%">Shipping</th>
                                    <th class="text-center" width="5%">Total</th>
                                    <th class="text-center" width="5%">Date</th>
                                    <th class="text-center" width="5%">Status</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-center">{{ $order->payment_type }}</td>
                                        <td class="text-center">{{ $order->balance_transaction }}</td>
                                        <td class="text-center">{{ $order->subtotal }}</td>
                                        <td class="text-center">{{ $order->shipping_charge }}</td>
                                        <td class="text-center">{{ $order->total }}</td>
                                        <td class="text-center">{{ $order->date }}</td>
                                        <td class="text-center"><span class="badge badge-success">sent</span></td>

                                        <td class="text-center">

                                            <div class="form-group">
                                                <a href="{{ route('view.order', $order->id) }}"
                                                    class="btn btn-info btn-sm">View</a>
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
