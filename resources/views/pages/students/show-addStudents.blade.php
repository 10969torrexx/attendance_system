@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-8 col-lg-8 col-sm-8 col-8">
            <div class="card shadow">
                <div class="card-header text-primary font-weight-bold">Add Student</div>
                <div class="card-body">
                    <form action="{{ route('add_students') }}" method="POST"> @csrf
                        <div class="form-group">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror" 
                                    id="exampleFirstName" name="first_name"
                                        placeholder="First Name" required>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user @error('last_name') is-invalid @enderror" 
                                    id="exampleLastName" name="last_name"
                                        placeholder="Last Name" required>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <input type="date" class="form-control form-control-user @error('birth_date') is-invalid @enderror" 
                                    id="exampleLastName" name="birth_date"
                                    required>

                                @error('birth_date')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
