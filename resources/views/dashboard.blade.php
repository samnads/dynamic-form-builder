@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container mt-4">
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Forms</h5>
                    <h2 class="card-text">{{$count['forms']}}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Submissions</h5>
                    <h2 class="card-text">{{$count['form_submissions']}}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Date</h5>
                    <h2 class="card-text">{{date('d/m/Y')}}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Time</h5>
                    <h2 class="card-text">{{date('h:i A')}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection