@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <div class="row justify-content-center col-12">
        <div class="col-12 col-md-12 col-12 col-lg-12 col-xl-12">
            <div class="form-group row">
                <div class="col-2">
                    <select name="month" id="month" class="form-control">
                        <option value="">-- Month --</option>
                        @for ($i = 1; $i < 13; $i++)
                                <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1, date('Y'))) }}
                            </option>
                        @endfor
                   </select>
                </div>
                <div class="col-2">
                    <select name="year" id="year" class="form-control">
                        <option value="">-- Year --</option>
                        @php
                            $currentYear = date('Y');
                            for ($year = $currentYear; $year >= 2000; $year--) {
                                echo "<option value='$year'>$year</option>";
                            }
                        @endphp
                    </select>
                </div>
                <div class="col-2">
                    <a href="#" class="btn btn-primary" id="find-attendanceButton">Search</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center col-12">
        <div class="col-md-6 col-6 col-lg-6 col-xl-6">
            <div class="card shadow">
                <div class="card-header text-uppercase text-primary font-weight-bold">
                    Classes
                </div>
                <div class="card-body">
                    <div class="form-group" id="attendance-btn-container">
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody id="classes-table">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-6 col-lg-6 col-xl-6">
            <div class="card shadow">
                <div class="card-header text-uppercase text-primary font-weight-bold">
                    Attendance
                </div>
                <div class="card-body">
                    <div class="form-group row justify-content-center" id="">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="alert alert-primary" role="alert" >
                                <p class="font-weight-bold default">Present</p>
                                <p class="text-sm text-right default" id="num-present">0</p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="alert alert-warning" role="alert" >
                                <p class="font-weight-bold default">Late</p>
                                <p class="text-sm text-right default" id="num-late">0</p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="alert alert-danger" role="alert" >
                                <p class="font-weight-bold default">Absent</p>
                                <p class="text-sm text-right default" id="num-absent">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Remark</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="attendance-table">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.scripts.scripts-show-viewAttendance');
@endsection
