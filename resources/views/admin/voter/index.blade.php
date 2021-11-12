@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Voters</h3>
                <button class="btn btn-primary bg-gradient-primary float-right">Add Voter</button>
            </div>
            <div class="card-body">
                @include('admin.grid')
            </div>
        </div>
    </div>
@endsection
