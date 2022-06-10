<div class="modal fade" id="editProductModal" role="dialog" aria-labelledby="product-modal-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content p-3">
            <div class="modal-header mb-3">
                <h4 class="modal-title">Edit Item</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('products.ajax-update')}}" class="theme-form" id="edit_product_form" onsubmit="event.preventDefault();" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <input type="hidden" name="product_id" id="edit_product_id">
                            <!-- <label class="col-form-label pt-0">Select Category</label> -->
                            <select name="category_id" class="col-sm-12" id="edit_product_category">
                                <option value="" selected>Select Category</option>
                                @foreach ($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <!-- <label class="col-form-label pt-0">Select Shop</label> -->
                            <select name="shop_id" class=" col-sm-12" id="edit_product_shop">
                                <option value="" selected>Select Shop</option>
                                @foreach ($shops as $shop)
                                <option value="{{$shop->id}}">{{$shop->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <!-- <label class="col-form-label pt-0">Product Name</label> -->
                        <input class="form-control" type="text" placeholder="Product Name" name="name" id="edit_product_name" value="Product dummy Name">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-xl-6 col-md-12 col-12 mb-3 field-area">
                        <div class="input-group mobile-design-change bootstrap-touchspin @error('value') is-invalid @enderror">
                            <span class="touchspin-value" onclick="increaseByTen('#edit_product_value')">10</span>
                            <input class="form-control" type="number" min="0" step="0.01" id="edit_product_value" name="value" placeholder="Weight" style="display: block;">
                            <span class="input-group-text edit-product-type bootstrap-touchspin-postfix" style="border: unset;"></span>
                            <button onclick="decrease('#edit_product_value')" class="btn btn-primary btn-square bootstrap-touchspin-down touchspin-btn" type="button"><i class="fa fa-minus"></i></button>
                            <button onclick="increase('#edit_product_value')" class="btn btn-primary btn-square bootstrap-touchspin-up touchspin-btn" type="button"><i class="fa fa-plus"></i></button>
                            <label class="btn btn-custom-width btn-primary btn-square touchspin-btn  m-0" for="edit_type_pcs">pcs</i>
                            </label>
                            <label class="btn btn-custom-width btn-primary btn-square touchspin-btn m-0" for="edit_type_gram" type="button">gram</label>
                        </div>
                        @error('value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class=" col-xxl-6 col-xl-6 col-md-6 col-6 mb-3 field-area d-none">
                        <div class="d-flex justify-content-end align-items-center cus-justify-content-center">
                            <div class="d-block cursor-pointer custom-input-design w-100">
                                <input class="checkbox_animated custom-input edit_product_type" id="edit_type_pcs" value="pcs" type="radio" name="type">
                                <label for="edit_type_pcs" class="custom-input-label w-100">PCS</label>
                            </div>
                            <div class="d-block cursor-pointer custom-input-design w-100">
                                <input class="checkbox_animated custom-input edit_product_type" id="edit_type_gram" value="gram" type="radio" name="type">
                                <label for="edit_type_gram" class="custom-input-label reverse w-100">gram</label>
                            </div>
                        </div>
                    </div>

                    <div class=" col-xxl-8 col-xl-6 col-md-12 col-12  field-area">
                        <div class="input-group mobile-design-change bootstrap-touchspin @error('price') is-invalid @enderror">
                            <span class="touchspin-value" onclick="increaseByTen('#edit_product_price',true)"> 10 </span>
                            <span class="input-group-text">RM</span>
                            <input class="form-control" type="number" name="price" min="0" step="0.01" id="edit_product_price" placeholder="Price">
                            <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                            <!-- <button onclick="decrease('#edit_product_price',true)" class="btn btn-primary btn-square bootstrap-touchspin-down touchspin-btn" type="button"  ><i class="fa fa-minus"></i></button> -->
                            <button onclick="increase('#edit_product_price',true)" class="btn btn-primary btn-square bootstrap-touchspin-up touchspin-btn" type="button"><i class="fa fa-plus"></i></button>
                            <button onclick="increase('#edit_product_price',true,0.1)" class="btn btn-custom-width btn-primary btn-square bootstrap-touchspin-down touchspin-btn" type="button">0.1</i></button>
                            <button onclick="increase('#edit_product_price',true,0.01)" class="btn btn-custom-width btn-primary btn-square bootstrap-touchspin-up touchspin-btn" type="button">0.01</button>
                        </div>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="row " id="edit_advance_option">
                    <div class="mb-3 field-area">
                        <select name="country" class=" col-sm-12" id="edit_product_country">
                            <option value="choose" selected>Item Made From</option>
                            @foreach ($countries as $country)
                            <option value="{{$country->name}}" data-icon="fi-{{strtolower($country->sortname)}}">{{$country->name}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-6 field-area">
                        <div class=" offer-price-checkbox text-nowrap">
                            <div>
                                <input type="checkbox" id="edit_product_offer" name="is_offer">
                                <label for="edit_product_offer" style="font-size: 12px; color: #898989">Offer Price</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-6 field-area">
                        <div class=" offer-price-checkbox text-nowrap">
                            <div>
                                <input type="checkbox" id="edit_product_duty_free" name="is_duty_free">
                                <label for="edit_product_offer" style="font-size: 12px; color: #898989">Duty Free</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="mb-3 d-none">
                    <div class="input-group">
                        <input type="file" class="form-control" id="edit_product_image" onchange="previewFile(event,'edit_product_image_preview')" aria-describedby="edit_product_image" aria-label="Upload" accept="image/*">
                    </div>
                </div>

                <div class="m-3 user-profile" style="position:relative;">
                    <div class="product-img text-center ">
                        <img src="{{asset('assets/images/no-data-available.png')}}" style="border-radius: 50%" alt="product image" width="150px" id="edit_product_image_preview" height="150px">
                    </div>
                    <div class="icon-wrapper" onclick="$('#edit_product_image').trigger('click')"><i class="fa fa-pencil"></i></div>
                </div>
                <div class="modal-footer text-center text-sm-end" style="padding: 10px 0px 0px 0px;">
                    <button id="edit_product_delete" class="btn btn-outline-danger" type="button" onclick="deleteProduct($(this))">Delete Product</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="update_product_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
