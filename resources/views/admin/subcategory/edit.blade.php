@extends('admin.layout.admin_master')


@section('content')


    <div class="container">
        {{-- <div class="sl-mainpanel"> --}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit SubCateory</h5>
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
                        <form method="POST" action="{{ url("admin/dashboard/subcat/update/$subcat->id") }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">SubCategory Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    name="name" value="{{ $subcat->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($cats as $cat)
                                        <option value="{{ $cat->id }}"
                                             @if ($cat->id == $subcat->category_id) selected @endif>
                                            {{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info pd-x-20">Update</button>

                        </form>
                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div><!-- sl-pagebody -->
        </div><!-- sl-mainpanel -->
    </div><!-- container -->


@endsection

@section('script')



@endsection
