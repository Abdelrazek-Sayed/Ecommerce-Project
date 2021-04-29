@extends('web.layout')


@section('content')

    <div class="content_form">
        <div class="container">
            <div class="row">
                <div class="col-5 offset-lg-1">
                    <div class="contact_form_title">
                        <h4>Order Status</h4>
                        <div class="progress">
                            @if ($order->status == 0)
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 15%"
                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif ($order->status == 1)
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 15%"
                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif ($order->status == 2)
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 15%"
                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 20%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            @elseif ($order->status == 3)
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 15%"
                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 20%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-success" role="progressbar" style="width: 35%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                        </div><br>
                        @if ($order->status == 0)
                            <h4> Note : Your order under Review </h4>
                        @elseif ($order->status == 1)
                            <h4> Note : Payment accept Under Process </h4>
                        @elseif ($order->status == 2)
                            <h4> Note : Packing Done HandOver Process</h4>
                        @elseif ($order->status == 3)
                            <h4> Note : Your order Process Complete </h4>
                        @else
                            <h4> Note : Your order Cancelled </h4>
                        @endif

                    </div>
                </div>

                <div class="col-5 offset-lg-1">
                    <div class="contact_form_title">
                        <h4>Order Details</h4>
                        <ul class="list-group col-lg-12">
                            <li class="list-group-item"><b> payment_type :</b> {{ $order->payment_type }}</li>
                            <li class="list-group-item"><b>payment_id : </b> {{ $order->payment_id }}</li>
                            <li class="list-group-item"><b>balance_transaction :</b> {{ $order->balance_transaction }}
                            </li>
                            <li class="list-group-item"><b>shipping_charge : </b>{{ $order->shipping_charge }}$</li>
                            <li class="list-group-item"><b>vat : </b> {{ $order->vat }}$</li>
                            <li class="list-group-item"><b>subtotal :</b> {{ $order->subtotal }}&&$</li>
                            <li class="list-group-item"><b>total :</b> {{ $order->total }}$</li>
                            <li class="list-group-item"><b>month :</b>{{ $order->month }}</li>
                            <li class="list-group-item"><b>date :</b> {{ $order->date }}</li>
                            <li class="list-group-item"><b>year :</b> {{ $order->year }}</li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
