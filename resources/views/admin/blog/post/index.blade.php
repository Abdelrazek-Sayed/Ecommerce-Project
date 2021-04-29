@extends('admin.layout.admin_master')
@section('content')
    <div class="container">
        {{-- <div class="sl-mainpanel"> --}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Cateory</h5>
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
                        Post List
                        <a href="{{ route('add.blogPost') }}" class="btn btn-sm btn-warning" style="float: right;">Add
                            New</a>
                    </h6>
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p">serial</th>
                                    <th class="wd-15p">Title English</th>
                                    <th class="wd-15p">Title Arabic</th>

                                    <th class="wd-15p" width="10%">Image</th>
                                    <th class="wd-20p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $post->title_en }}</td>
                                        <td>{{ $post->title_ar }}</td>
                                        <td>
                                            <img src="{{ asset("uploads/$post->image") }}"
                                                style="height:100px; width:200px;">
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <a class="btn btn-success"
                                                    href="{{ url("admin/dashboard/blog/post/edit/$post->id") }}"
                                                    title="edit"><i class="fa fa-edit"></i>
                                                </a>
                                                <a id="delete"
                                                    href="{{ url("admin/dashboard/blog/post/delete/$post->id") }}"
                                                    class="btn btn-danger" title="delete"><i class="fa fa-trash"></i></a>
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
