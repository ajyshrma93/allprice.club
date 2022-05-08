<div class="modal fade " id="bulkUploadProduct" tabindex="-1" role="dialog" aria-labelledby="bulkUploadProduct" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3">
                <h4 class="modal-title">Bulk Image Upload</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <form class="theme-form" id="bulk_upload_form" action="{{route('products.bulk-upload')}}" onsubmit="event.preventDefault()">
                @csrf
                <div class="mb-3">
                    <label class="col-form-label pt-0">Select Shop</label>
                    <select name="shop_id" class=" col-sm-12 " id="modalSelect-2" tabindex="-1" aria-hidden="true">
                        <option value="">Select Shop</option>
                        @foreach ($shops as $shop)
                        <option value="{{$shop->id}}">{{$shop->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label pt-0">Upload Images</label>
                    <div class="input-group">
                        <input type="file" name="product_images" accept="image/*" class="form-control" id="bulk_upload_images" aria-describedby="inputGroupFileAddon04" aria-label="Upload" multiple="" data-bs-original-title="" title="">
                    </div>
                </div>
                <div class="modal-footer border-0 text-center text-sm-end">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" data-bs-original-title="" title="">Cancel</button>
                    <button class="btn btn-primary" id="bulk_upload_form_btn" title="">Add Items</button>
                </div>
            </form>

        </div>
    </div>
</div>
