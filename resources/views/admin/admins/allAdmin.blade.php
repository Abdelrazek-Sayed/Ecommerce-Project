@extends('admin.layout.admin_master')


@section('content')


    <div class="container">
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Admins</h5>
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
                        Pending admins
                    </h6> --}}
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                                <tr>

                                    <th class="text-center" width="5%">Name</th>
                                    {{--  <th class="text-center" width="5%">Email</th>  --}}
                                    <th class="text-center" width="5%">Role</th>
                                    <th class="text-center">Access</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td class="text-center">{{ $admin->name }}</td>
                                        {{--  <td class="text-center">{{ $admin->email }}</td>  --}}
                                        <td class="text-center">{{ $admin->roleName->name }}</td>
                                        <td>

                                            @if ($admin->roleName->name == 'superadmin')
                                                <span class="badge badge-success">admins</span>
                                            @endif

                                            @if ($admin->data)
                                                <span class="badge badge-warning">data</span>
                                            @endif
                                            @if ($admin->oredrs)
                                                <span class="badge badge-success">oredrs</span>
                                            @endif
                                            @if ($admin->others)
                                                <span class="badge badge-danger">others</span>
                                            @endif
                                            @if ($admin->report)
                                                <span class="badge badge-info">report</span>
                                            @endif
                                            @if ($admin->product)
                                                <span class="badge badge-primary">product</span>
                                            @endif
                                            @if ($admin->blog)
                                                <span class="badge badge-warning">blog</span>
                                            @endif
                                            @if ($admin->newsletters)
                                                <span class="badge badge-danger">newsletters</span>
                                            @endif
                                            @if ($admin->return)
                                                <span class="badge badge-info">return</span>
                                            @endif
                                            @if ($admin->contact)
                                                <span class="badge badge-success">contact</span>
                                            @endif
                                            @if ($admin->setting)
                                                <span class="badge badge-info">setting</span>
                                            @endif
                                            @if ($admin->comment)
                                                <span class="badge badge-primary">comment</span>
                                            @endif
                                            @if ($admin->copoun)
                                                <span class="badge badge-success">copoun</span>
                                            @endif

                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                <a href="{{ route('edit.admin', $admin->id) }}"
                                                    class="btn btn-info btn-sm">Edit</a>
                                                <a id="delete" href="{{ route('delete.admin', $admin->id) }}"
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
