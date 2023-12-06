@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- Earnings (Monthly) Card Example -->
        <div class="card shadow col-md-8 col-lg-8 col-sm-8 col-8">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Students</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Birth Date</th>
                                <th>Age</th>
                                <th>With Class</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->first_name }}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>{{ date('F d, Y', strtotime($item->birth_date)) }}</td>
                                    <td>{{ date('Y') - date('Y', strtotime($item->birth_date)) }}</td>
                                    <td>{{ ($item->with_class == 0) ? 'No' : 'Yes' }}</td>
                                    <td>{{ date('F d, Y', strtotime($item->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.scripts.scripts-show-viewClass');
@endsection
