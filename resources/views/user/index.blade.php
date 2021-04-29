@extends('web.layout')

@section('content')

    <div class="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-8 card">
                    <table class="table table-success table-striped">
                        <table class="table">
                            @php
                                $orders = $user->orders;
                            @endphp
                            <thead>
                                <tr>
                                    <th scope="col">Serial</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Bill</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Status Code</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $order->payment_type }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->date }}</td>
                                        <td>
                                            @if ($order->status == 0)
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($order->status == 1)
                                                <span class="badge badge-info">Payment Accept</span>
                                            @elseif($order->status == 2)
                                                <span class="badge badge-primary">Progress</span>
                                            @elseif($order->status == 3)
                                                <span class="badge badge-success">Delevered</span>
                                            @else
                                                <span class="badge badge-danger">Canceled</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $order->status_code }}</td>
                                        <td>
                                            <div class="form-group">
                                                <a href="{{ route('web.view.order', $order->id) }}"
                                                    class="btn btn-info btn-sm">View</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </table>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="mb-3 py-3">
                            <img src="{{ !empty($user->image) ? url("uploads/$user->image") : url('uploads/no_image.jpg') }}"
                                class="card-img-top" style="height: 120px; width:120px; margin-left:34%;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $user->name }}</h5>
                            <p class="card-text text-center">{{ $user->email }}</p>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="{{ route('user.edit.password') }}"><span><i
                                                class="fas fa-cogs"></i></span> Password Change</a></li>
                                <li class="list-group-item"><a href="{{ route('user.edit.profile') }}"><i
                                            class="fas fa-cogs"></i> Edit Profile</a></li>
                                <li class="list-group-item"><a href="{{ route('order.list') }}"><i
                                            class="fas fa-cogs"></i> Return Order</a></li>
                                <li class="btn btn-danger btn-sm btn-block"> <a
                                        href="{{ route('user.logout') }}">Logout</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
