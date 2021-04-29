@extends('admin.layout.admin_master')


@section('content')


    <div class="container">
        {{-- <div class="sl-mainpanel"> --}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>NesLetter</h5>
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
                    <form method="POST">
                        @csrf
                        @method('Delete')
                        <h6 class="card-body-title">
                            NesLetters List
                            <button formaction="{{ route('admin.deleteSelected.newsletter') }}" type="submit"
                                class="btn btn-sm btn-warning" style="float: right;">Delete Selectd</button>
                        </h6>

                        <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th width="2%"></th>
                                        <th class="wd-15p text-center" width="5%">serial</th>
                                        <th class="wd-15p text-center" width="25%">Email</th>
                                        <th class="wd-20p text-center" width="15%">Subscriber Time</th>
                                        <th class="wd-20p text-center" width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($newsletters as $newsletter)
                                        <tr>
                                            <td><input type="checkbox" name="ids[]" value="{{ $newsletter->id }}"></td>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $newsletter->email }}</td>
                                            <td class="text-center">
                                                {{ Carbon\Carbon::parse($newsletter->created_at)->diffForHumans() }}
                                            </td>
                                            <td>
                                                <div class="form-group text-center">
                                                    <a id="delete"
                                                        href="{{ url("admin/dashboard/newsletter/delete/$newsletter->id") }}"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div><!-- table-wrapper -->
                    </form>
                </div><!-- card -->
            </div><!-- sl-pagebody -->
        </div><!-- sl-mainpanel -->
    </div><!-- container -->
@endsection
