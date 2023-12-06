@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        @if (count($classes) > 0)
            @foreach ($classes as $item)
                <div class="col-3 col-md-3 col-xl-3 col-lg-3">
                    <div class="card shadow mb-4">
                        <div class="card-header text-primary font-weight-bold text-nowrap">{{ $item->name }}</div>
                        <div class="card-body">
                        <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="alert alert-primary" role="alert" >
                                        <p class="font-weight-bold default">Present</p>
                                        <p class="text-sm text-right default" id="num-present">{{ $item->total_present }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="alert alert-warning" role="alert" >
                                        <p class="font-weight-bold default">Late</p>
                                        <p class="text-sm text-right default" id="num-late">{{ $item->total_late }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="alert alert-danger" role="alert" >
                                        <p class="font-weight-bold default">Absent</p>
                                        <p class="text-sm text-right default" id="num-absent">{{ $item->total_absent }}</p>
                                    </div>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-3 col-md-3 col-xl-3 col-lg-3">
                <div class="logo-container">
                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                    <lottie-player src="https://lottie.host/5669eab2-3e79-47c2-b6c3-c738142efa72/m6OcRR9mTa.json" background="" speed="1" style="width: 500px; height: 500px" loop autoplay direction="1" mode="normal"></lottie-player>
                </div>
                <h5 class="text-center">Nothing to show as of the moment!</h5>

            </div>
        @endif
    </div>
</div>
@include('pages.scripts.scripts-show-addClass')
@endsection
