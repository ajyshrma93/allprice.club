<div class="modal fade" id="editcategory" tabindex="-1" role="dialog" aria-labelledby="editcategory" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3">
                <h4 class="modal-title">Edit Category</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="theme-form" action="{{route('category.ajax-update')}}" id="edit_category_form">
                @csrf
                <div class="mb-3">
                    <label class="col-form-label pt-0">Edit Category Name</label>
                    <input name="id" type="hidden" id="edit_category_id">
                    <input class="form-control" type="text" placeholder="e.g. Alibaba" name="name" id="edit_catgeory_name">
                </div>
                <div class="mb-3">
                    <label class="col-form-label pt-0">Category Image</label>
                    <div class="input-group">
                        <input accept="image/*" type="file" class="form-control" onchange="previewFile(event,'edit_catgeory_image_preview')" id="edit_category_image" name="catgeory_image" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon04">Upload</button>
                    </div>
                </div>
                <div class="m-3 user-profile" style="position:relative;">
                    <div class="product-img text-center ">
                        <img src="{{asset('assets/images/no-data-available.png')}}" style="border-radius: 50%" alt="product image" width="150px" id="edit_catgeory_image_preview" height="150px">
                    </div>
                    <div class="icon-wrapper" onclick="$('#edit_category_image').trigger('click')"><i class="fa fa-pencil"></i></div>
                </div>
            </form>
            <div class="modal-footer border-0 text-center text-sm-end">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="update_category">Save Changes</button>
            </div>
        </div>
    </div>
</div>
