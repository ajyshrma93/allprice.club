<div class="modal fade" id="editProductModal" role="dialog" aria-labelledby="product-modal-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content p-3">
            <div class="modal-header mb-3">
                <h4 class="modal-title">Edit Product</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('products.ajax-update')}}" class="theme-form" id="edit_product_form" onsubmit="event.preventDefault();" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <input type="hidden" name="product_id" id="edit_product_id">
                            <label class="col-form-label pt-0">Select Category</label>
                            <select name="category_id" class="js-example-basic-single col-sm-12" id="edit_product_category">
                                <option value="" selected>Select Category</option>
                                @foreach ($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="col-form-label pt-0">Select Shop</label>
                            <select name="shop_id" class="js-example-basic-single col-sm-12" id="edit_product_shop">
                                <option value="" selected>Select Shop</option>
                                @foreach ($shops as $shop)
                                <option value="{{$shop->id}}">{{$shop->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0">Product Name</label>
                        <input class="form-control" type="text" placeholder="Name" name="name" id="edit_product_name" value="Product dummy Name">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="col-form-label pt-0">Select Country</label>
                    <select name="country" class="js-example-basic-single col-sm-12" id="edit_product_country">
                        @foreach ($countries as $country)
                        <option value="{{$country->name}}" {{$country->sortname =='MY' ?'selected':''}} data-icon="fi-{{strtolower($country->sortname)}}">{{$country->name}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-3 row">
                    <div class=" col-xxl-4 col-xl-6 col-md-6 col-6 mb-3 field-area">
                        <div class="input-group mobile-design-change bootstrap-touchspin @error('value') is-invalid @enderror">
                            <span class="touchspin-value" onclick="increaseByTen('#edit_product_value')">10</span>
                            <input class="form-control" type="number" min="0" step="0.01" id="edit_product_value" name="value" placeholder="Weight" style="display: block;" data-bs-original-title="" title="">
                            <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                            <button onclick="decrease('#edit_product_value')" class="btn btn-primary btn-square bootstrap-touchspin-down touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-minus"></i></button>
                            <button onclick="increase('#edit_product_value')" class="btn btn-primary btn-square bootstrap-touchspin-up touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-plus"></i></button>
                        </div>
                        @error('value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class=" col-xxl-4 col-xl-6 col-md-6 col-6 mb-3 field-area">
                        <div class="d-flex justify-content-end align-items-center cus-justify-content-center">
                            <div class="d-block cursor-pointer custom-input-design w-100">
                                <input class="checkbox_animated custom-input" value="pcs" type="radio" name="edit_type">
                                <label for="edit_type_pcs" class="custom-input-label w-100">PCS</label>
                            </div>
                            <div class="d-block cursor-pointer custom-input-design w-100">
                                <input class="checkbox_animated custom-input" value="gram" type="radio" name="edit_type">
                                <label for="edit_type_gram" class="custom-input-label reverse w-100">gram</label>
                            </div>
                        </div>
                    </div>

                    <div class=" col-xxl-4 col-xl-6 col-md-6 col-6 mb-3 field-area">
                        <div class="input-group mobile-design-change bootstrap-touchspin @error('price') is-invalid @enderror">
                            <span class="touchspin-value" onclick="increaseByTen('#edit_product_price')"> 10 </span>
                            <input class="form-control" type="number" name="price" min="0" step="0.01" id="edit_product_price" placeholder="Price" data-bs-original-title="" title="">
                            <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                            <button onclick="decrease('#edit_product_price')" class="btn btn-primary btn-square bootstrap-touchspin-down touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-minus"></i></button>
                            <button onclick="increase('#edit_product_price')" class="btn btn-primary btn-square bootstrap-touchspin-up touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-plus"></i></button>
                        </div>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-6 mb-3 d-flex  field-area">
                        <div class=" offer-price-checkbox text-nowrap">
                            <div>
                                <input type="checkbox" id="edit_product_offer" name="is_offer">
                                <label for="edit_product_offer" style="font-size: 12px; color: #898989">Offer Price</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="col-form-label pt-0">Product Image</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="edit_product_image" onchange="previewFile(event,'edit_product_image_preview')" aria-describedby="edit_product_image" aria-label="Upload" accept="image/*">
                        <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon04">Upload</button>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="product-img text-center">
                        <img src="{{asset('assets/images/no-data-available.png')}}" alt="product image" width="100%" id="edit_product_image_preview" height="150px">
                    </div>
                </div>
                <div class="modal-footer text-center text-sm-end" style="padding: 0px;">
                    <button id="edit_product_delete" class="btn btn-outline-danger" type="button" onclick="deleteProduct($(this))">Delete Product</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="update_product_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
