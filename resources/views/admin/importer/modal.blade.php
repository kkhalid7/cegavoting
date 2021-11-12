<div class="modal" tabindex="-1" role="dialog" id="importer-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Importer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form class="form form-multipart" method="post" action="{{route('admin::importers.store')}}">
                <div class="modal-body">
                    <div class="mb-2">
                        <div><span class="h6 text-bold">Sample files</span></div>
                        <div class="">
                            <a href="/samples/voter_sample.csv"><span class="badge bg-lightblue bg-gradient-lightblue">Voters</span></a>
                            <a href="/samples/category_sample.csv"><span class="badge bg-lightblue bg-gradient-lightblue">categories</span></a>
                            <a href="/samples/nominee_sample.csv"><span class="badge bg-lightblue bg-gradient-lightblue">Nominees</span></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            @foreach($types as $type)
                                <option value="{{$type}}">{{$type}}</option>
                            @endforeach
                        </select>
                        <span class="error-type"></span>
                    </div>
                    <div class="form-group">
                        <label>Upload File</label>
                        <input type="file" name="input_file">
                        <span class="error-input_file"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light pull-left bg-gradient-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary bg-gradient-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
