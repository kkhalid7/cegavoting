@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h5 class="text-uppercase">
                            Importer
                            <span class="text-right">
                            <button type="button" class="btn btn-primary float-right bg-gradient-primary" data-toggle="modal"
                                    data-target="#importer-modal">Add</button>
                            </span>
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('admin.grid')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.importer.modal')
@endsection
