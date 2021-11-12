<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="{{asset('grid/jquery-date-range-picker/jquery.daterangepicker.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('grid/jquery-date-range-picker/daterangepicker.min.css')}}" />
<link rel="stylesheet" href="{{asset('grid/grid.css')}}">
<style>
    .badge {
        font-weight: normal !important;
    }
</style>
<div class="grid card elevation-3">
    {!!$grid!!}
</div>
<script type="text/javascript" src="{{asset('grid/grid.js')}}"></script>
