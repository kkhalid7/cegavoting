<div class="modal" tabindex="-1" role="dialog" id="category-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Categories</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form class="form" method="post" action="{{route('admin::add.categories')}}">
                <div class="modal-body">
                    <input type="hidden" name="id" id="nominee_id">
                    <div class="form-group">
                        <label>Choose Category</label>
                        <select name="categories[]" class="custom-select" id="nominee_select" multiple="multiple" style="width: 100%">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <span class="error-categories"></span>
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
