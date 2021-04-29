@extends('admin.layout.admin_master')


@section('content')
    <div class="container">
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <div class="table-wrapper">
                    <div class="row">
                        <div class="col-lg-4">
                                <form method="POST" action="{{ route('search.date') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Search By Date</label>
                                    <input type="date" class="form-control"  name="date">
                                </div>

                                <button type="submit" class="btn btn-info pd-x-20">Search</button>
                            </form>
                        </div><!-- card -->

                        <div class="col-lg-4">
                            <form method="POST" action="{{ route('search.month') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Search By Month</label>
                                    <select size="1" class="form-control" name="month">
                                        <option selected value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>

                                </div>

                                <button type="submit" class="btn btn-info pd-x-20">Search</button>
                            </form>
                        </div><!-- card -->

                        <div class="col-lg-4">
                            <form method="POST" action="{{ route('search.year') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Search By Year</label>

                                    <select size="1" class="form-control" name="year">
                                        <option  value="2015">2015</option>
                                        <option  value="2016">2016</option>
                                        <option  value="2017">2017</option>
                                        <option  value="2018">2018</option>
                                        <option  value="2019">2019</option>
                                        <option  value="2020">2020</option>
                                        <option  selected value="2021">2021</option>


                                    </select>
                                </div>

                                <button type="submit" class="btn btn-info pd-x-20">Search</button>
                            </form>
                        </div><!-- card -->
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
