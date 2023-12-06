@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center col-12">
        <div class="col-md-8 col-8 col-lg-8 col-xl-8">
            <div class="card shadow">
                <div class="card-header text-uppercase text-primary font-weight-bold">Teachers with no Class</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Date Added</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachers as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td>{{ date('F d, Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <a href="#" class="btn btn-warning" id="select-teacher" data-id="{{ $item->id }}">Select</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-4 col-sm-4 col-lg-4">
            <div class="card shadow">
                <div class="card-header text-uppercase text-primary font-weight-bold">Assign Class</div>
                <div class="card-body">
                    <form action="{{ route('assign_class') }}" method="post">
                        @csrf
                        <input type="text" id="teacher-id" hidden class="d-none" name="teacher_id">
                        <div class="form-group px-2" id="teacher-details">
                            <p>Full name: </p>
                        </div>
                        <div class="form-group px-2" id="teacher-details">
                           <label for="">Classes:</label>
                           <select name="class_id" id="" class="form-control" required>
                                <option value="">-- choose --</option>
                                @foreach ($classes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                           </select>
                        </div>
                        <div class="form-group px-2" >
                            <button type="submit" class="btn btn-primary">Assign Class</button>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.scripts.scripts-show-assignSection');
@endsection
