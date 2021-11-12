@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nominee</h3>
                {{--                <button class="btn btn-primary bg-gradient-primary float-right">Add Voter</button>--}}
            </div>
            <div class="card-body">
                @include('admin.grid')
            </div>
        </div>
    </div>
    @include('admin.nominee.modal')
    @include('admin.nominee.image_modal')
@endsection

@section('js')
    <script>

        $('#nominee_select').select2({
            placeholder: 'Choose Category',
            allowClear: true
        });
        $('#category-modal').on('show.bs.modal', function (e) {
            let modal = $(this);
            let button = $(e.relatedTarget);
            let id = button.data('id');
            let categories = button.data('categories');
            modal.find('.modal-body #nominee_id').val(id);
            $('#nominee_select').val(categories);
            $('#nominee_select').trigger('change');

        });

        $('#image').on('change', function () {
            if($(this).val() === ''){
                $(this).next('.custom-file-label').html('Choose file');
            }else{
                let fileName = $(this).val().split('\\');
                $(this).next('.custom-file-label').html(fileName[fileName.length - 1]);
            }
        });

        $('#image-modal').on('show.bs.modal',  function (e){
            let modal = $(this);
            let button = $(e.relatedTarget);
            let id = button.data('id');
            modal.find('.modal-body #nominee_id').val(id);
        });
    </script>
@endsection
