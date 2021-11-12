<?php $cfg =  $filter->getConfig(); ?>
<div class="datetimerangepicker">
    <input class="form-control" name="{{$filter->getInputName()}}" value="{{$filter->getValue()}}" />
</div>

<script type="text/javascript">
    $('.datetimerangepicker>input[name="{{$filter->getInputName()}}"]').dateRangePicker({!!json_encode(empty($cfg->get("config")) ? [] : $cfg->get("config"))!!})
        .bind('datepicker-change',function(event,obj){
            $(this).closest('form').submit();
        });
</script>
