@extends('admin.layout.admin_master')


@section('content')


    <div class="container">
        {{-- <div class="sl-mainpanel"> --}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Sub Cateory</h5>
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
                        SubCategory List
                        <a class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal"
                            data-target="#modaldemo3">Add SubCategory</a>
                    </h6>
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p">serial</th>
                                    <th class="wd-15p">Subcategory Name</th>
                                    <th class="wd-15p">Ctegory Name</th>
                                    <th class="wd-20p">Created at</th>
                                    <th class="wd-20p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcats as $subcat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subcat->name }}</td>
                                        {{--  <td>{{ $subcat->catName}}</td>   --}}
                                        <td>{{ $subcat->category->name}}</td>
                                        <td>
                                            @if ($subcat->created_at == null)
                                                <span class="text-danger">No Date</span>
                                            @else
                                                {{ Carbon\Carbon::parse($subcat->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <a class="btn btn-success"
                                                    href="{{ url("admin/dashboard/subcat/edit/$subcat->id") }}">Edit
                                                    Category</a>
                                                <a id="delete" href="{{ url("admin/dashboard/subcat/delete/$subcat->id") }}"
                                                    class="btn btn-danger">Delete</a>

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


    <!-- LARGE MODAL -->
    <div id="modaldemo3" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add SubCategory</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <form method="POST" action="{{ route('admin.store.subcat') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">SubCategory Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category Name</label>
                            <select name="category_id" class="form-control">
                                @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection

