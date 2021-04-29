@extends('admin.layout.admin_master')


@section('content')
    <div class="container">
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="sl-page-title">
                                    <h5>Message</h5>
                                </div><!-- sl-page-title -->
                                <table class="table">
                                    <tr>
                                        <th>Name : </th>
                                        <th>{{ $message->name }}</th>
                                    </tr>
                                    <tr>
                                        <th>Phone : </th>
                                        <th>{{ $message->phone }}</th>
                                    </tr>
                                    <tr>
                                        <th>Email : </th>
                                        <th>{{ $message->email }}</th>
                                    </tr>
                                    <tr>
                                        <th>Message : </th>
                                        <th>{{ $message->message }}</th>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-body p-0">
                    <form method="POST" action="{{ route('response.message', $message->id) }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label>Body</label>
                                            <textarea name="body" class="form-control" rows="12"></textarea>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Send Response</button>
                                        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
