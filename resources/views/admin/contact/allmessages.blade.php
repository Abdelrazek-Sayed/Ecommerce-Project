@extends('admin.layout.admin_master')


@section('content')


    <div class="container">
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Pending Orders</h5>
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
                        {{-- <table id="datatable1" class="table display responsive nowrap"> --}}
                        <table class="table">
                            <thead>
                                <tr>

                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="5%">Name</th>
                                    <th class="text-center" width="5%">Phone</th>
                                    <th class="text-center" width="5%">Email</th>

                                    {{--  <th class="text-center">Message</th>  --}}
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($msgs as $msg)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $msg->name }}</td>
                                        <td>{{ $msg->phone }}</td>
                                        <td>{{ $msg->email }}</td>

                                        {{--  <td>{!! $msg->message !!}</td>  --}}


                                        <td>

                                            <div class="form-group">
                                                <a href="{{ route('show.message', $msg->id) }}"
                                                    class="btn btn-info btn-sm">Show</a>

                                                <a href="{{ route('delete.message', $msg->id) }}"
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



@endsection
