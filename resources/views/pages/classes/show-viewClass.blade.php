@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- Earnings (Monthly) Card Example -->
        <div class="card shadow col-md-8 col-lg-8 col-sm-8 col-8">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Classes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>With Teacher?</th>
                                <th>Teacher Name</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ ($item->teacher_id == 0) ? 'No' : 'Yes' }}</td>
                                    <td>{{ ($item->teacher_name == null) ? 'N/A' : $item->teacher_name }}</td>
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
