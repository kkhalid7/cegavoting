<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLongTitle">Upload Image </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin::nominee.image.store')}}" method="post" class="form form-multipart">
                <div class="modal-body">
                    <input type="hidden" name="nominee_id" id="nominee_id">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image" >
                        <label class="custom-file-label" for="image">Choose file</label>
                        <small class="text-danger error error-image d-none"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger bg-gradient-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary bg-gradient-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
