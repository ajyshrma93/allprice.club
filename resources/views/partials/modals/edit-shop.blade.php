<div class="modal fade" id="editShop" tabindex="-1" role="dialog" aria-labelledby="editShop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3">
                <h4 class="modal-title">Edit Shop</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="theme-form" action="{{route('shops.ajax-update')}}" id="edit_shop_form">
                @csrf
                <div class="mb-3">
                    <label class="col-form-label pt-0">Edit Shop Name</label>
                    <input name="id" type="hidden" id="edit_shop_id">
                    <input class="form-control" type="text" placeholder="e.g. Alibaba" name="name" id="edit_shop_name">
                </div>
                <div class="mb-3">
                    <label class="col-form-label pt-0">Shop Image</label>
                    <div class="input-group">
                        <input accept="image/*" type="file" class="form-control" onchange="previewFile(event,'edit_shop_image_preview')" id="edit_shop_image" name="shop_image" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon04">Upload</button>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="product-img text-center">
                        <img class="img-fluid" src="{{asset('assets/images/no-data-available.jpg')}}" id="edit_shop_image_preview" alt="shop image">
                    </div>
                </div>
            </form>
            <div class="modal-footer border-0 text-center text-sm-end">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="update_shop">Save Changes</button>
            </div>
        </div>
    </div>
</div>
