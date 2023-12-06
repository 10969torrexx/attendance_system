@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-8 col-lg-8 col-sm-8 col-8">
            <div class="card shadow">
                <div class="card-header text-primary font-weight-bold">Add Class</div>
                <div class="card-body">
                    <form action="{{ route('add_class') }}" method="POST"> @csrf
                        <div class="form-group">
                            <input type="name" class="form-control form-control-user @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}"
                                required autocomplete="name" autofocus
                                id="exampleInputEmail" aria-describedby="emailHelp"
                                placeholder="Enter class name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Class</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.scripts.scripts-show-addClass');
@endsection
