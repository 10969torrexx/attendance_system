@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <div class="row justify-content-center col-12">
        <div class="col-12 col-md-12 col-12 col-lg-12 col-xl-12">
            <div class="form-group col-12">
                <h4><strong class="text-primary">{{ date('F d, Y') }}</strong></h4>
                <div class="text-info" id="clock"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center col-12">
        <div class="col-md-6 col-6 col-lg-6 col-xl-6">
            <div class="card shadow">
                <div class="card-header text-uppercase text-primary font-weight-bold">Classes</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Teacher</th>
                                    <th>Date Added</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ ($item->teacher_name == null) ? 'N/A' : $item->teacher_name }}</td>
                                        <td>{{ date('F d, Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            @if ($item->teacher_id != 0)
                                                <a href="#" class="btn" id="select-class" data-id="{{ $item->id }}">
                                                    <i class="fa fa-eye text-primary"></i>
                                                </a>
                                            @else
                                                <a href="#" class="btn" id="no-teacherClass">
                                                    <i class="fa fa-eye text-secondary"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-6 col-lg-6 col-xl-6">
            <div class="card shadow">
                <div class="card-header text-uppercase text-primary font-weight-bold">
                    Students
                </div>
                <div class="card-body">
                    <div class="form-group" id="attendance-btn-container">
                    </div>
                    <form action="{{ route('set_classAttendance') }}" method="post" id="attendance-form">
                        @csrf
                        <input type="text" class="form-control d-none" hidden id="class-id" name="class_id">
                        <div class="d-none" hidden id="student-id-container">

                        </div>
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                            <tbody id="student-table">
    
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.scripts.scripts-show-setAttendance');
@endsection
