@extends('web.layout')


@section('content')
    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <div class="row">
                    <div class="col-8 card">
                        <table class="table table-success table-striped">
                            <table class="table">

                                <thead>
                                    <tr>
                                        <th scope="col">Serial</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Return</th>
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
                                            <td>
                                                @if ($order->return_order == 0)
                                                    <span class="badge badge-warning">No Request</span>
                                                @elseif($order->return_order == 1)
                                                <span class="badge badge-warning">Waiting</span>
                                                @elseif($order->return_order == 2)
                                                    <span class="badge badge-info">Returned</span>
                                                @endif
                                            </td>
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
                                            <td class="">{{ $order->status_code }}</td>
                                            <td>
                                                <div class="form-group">
                                                    @if ($order->return_order == 0)
                                                        <a id="return" href="{{ route('return.order', $order->id) }}"
                                                            class="btn btn-danger btn-sm">Return</a>
                                                    @elseif($order->return_order == 1)
                                                    <span class="badge badge-warning">Waiting</span>
                                                    @elseif($order->return_order == 2)
                                                        <span class="badge badge-info">Returned</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>
    <script>
        $(document).on("click", '#return', function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                    title: "Are you sure you want to Return ?",
                    text: "Once returned, you will take your money in 2 dayes!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        });

    </script>
@endsection
