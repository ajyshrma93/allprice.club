@extends('layouts.app')

@section('content')
<style>
    .touchspin-value {
        text-align: center;
        width: 33px;
        height: 36px;
        background: #7366FF;
        font-size: 13px;
        color: white;
        padding-top: 8px;
        border-radius: 4px 0px 0px 4px;
    }


</style>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-6">
                    <h3 class="user-itesm-title">My Favorites</h3>
                </div>
                <div class="col-md-6 col-sm-4 col-6">
                    <div class="create-new-items">
                        <button class="btn btn-primary me-2" type="button" id="productFormSm">
                            <span class="me-2 d-none d-md-flex">Add Single Product</span>
                            <i data-feather="chevron-down" class="d-none d-md-flex"></i>
                            <i data-feather="plus" class="d-flex d-md-none"></i>
                        </button>
                        <button class="d-none d-md-flex btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#bulkUploadProduct">
                            <span class="me-2">Bulk Image Upload</span>
                            <i data-feather="upload-cloud"></i>
                        </button>
                        <button class="d-flex d-md-none btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#bulkUploadProduct">
                            <i data-feather="upload-cloud"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- new product form start -->
            <div class="col-12 product-form-area @if($errors->any()) d-block @enderror">
                <div class="card">
                    <div class="card-header">
                        <h5>Add new products</h5>
                        <span>Please fill up the form below to add new products</span>
                    </div>
                    <form class="theme-form" onsubmit="event.preventDefault();" action="{{route('products.store')}}" id="add_product_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="row" id="product_add_box">
                                <div class="col-xl-6 col-6 mb-3">
                                    <div class="row">
                                        <div class="col-xxl-7 col-xl-6 col-md-8 col-sm-7 newItem">
                                            <select name="category_id" class="select2 col-sm-12 @error('category_id') is-invalid @enderror" id="product_cat">
                                                <option value="" selected>Select Category</option>
                                                @foreach ($categories as $cat)
                                                <option value="{{$cat->id}}" {{$cat->id == old('category_id') ?'selected':''}}>{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-xxl-5 col-xl-6 col-md-4 col-sm-auto ms-md-0 mt-sm-0 ms-auto mt-3 text-end newItemBtn">
                                            <button class="btn btn-primary new-shop-btn cus-new-shop-btn" type="button" data-bs-toggle="modal" data-bs-target="#add_catgeory_modal">
                                                <span>New Category</span>
                                                <i data-feather="plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-6 mb-3">
                                    <div class="row">
                                        <div class="col-xxl-7 col-xl-6 col-md-8 col-sm-7 newItem">
                                            <select name="shop_id" class="form-control select2 col-sm-12  @error('shop_id') is-invalid @enderror" id="product_shop">
                                                <option value="" selected>Select Shop</option>
                                                @foreach ($locatedShops as $shop)
                                                <option value="{{$shop->id}}" {{$shop->id == old('shop_id') ?'selected':''}}>{{$shop->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('shop_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-xxl-5 col-xl-6 col-md-4 col-sm-auto ms-md-0 mt-sm-0 ms-auto mt-3 text-end newItemBtn">
                                            <button class="btn btn-primary new-shop-btn cus-new-shop-btn" type="button" data-bs-toggle="modal" data-bs-target="#add_shop_modal">
                                                <span>Add New Shop</span>
                                                <i data-feather="plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3 product-name-field">
                                    <input class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" type="text" name="name" placeholder="Product Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class=" col-xxl-4 col-xl-6 col-md-6 col-6 mb-3 field-area">
                                    <div class="input-group mobile-design-change bootstrap-touchspin @error('value') is-invalid @enderror">
                                        <span class="touchspin-value" onclick="increaseByTen('#product_value')">10</span>
                                        <input class="form-control" type="number" min="1" value="1" id="product_value" name="value" placeholder="Weight" style="display: block;" value="{{old('value')}}">
                                        <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                                        <button onclick="decrease('#product_value')" class="btn btn-primary btn-square bootstrap-touchspin-down touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-minus"></i></button>
                                        <button onclick="increase('#product_value')" class="btn btn-primary btn-square bootstrap-touchspin-up touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-plus"></i></button>
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
                                            <input class="checkbox_animated custom-input" id="edo-ani-2" value="pcs" type="radio" name="type" checked>
                                            <label for="edo-ani-2" class="custom-input-label w-100">PCS</label>
                                        </div>
                                        <div class="d-block cursor-pointer custom-input-design w-100">
                                            <input class="checkbox_animated custom-input" id="edo-ani1-2" value="gram" type="radio" name="type" {{'gram' == old('type') ?'checked':''}}>
                                            <label for="edo-ani1-2" class="custom-input-label reverse w-100">gram</label>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-xxl-6 col-xl-6 col-md-12 col-12 mb-3 field-area">
                                    <div class="input-group mobile-design-change bootstrap-touchspin @error('price') is-invalid @enderror">
                                        <span class="touchspin-value" onclick="increaseByTen('#product_price',true)"> 10 </span>
                                        <input class="form-control" type="number" name="price" min="0" value="{{old('price')}}" step="0.01" id="product_price" placeholder="Price" data-bs-original-title="" title="">
                                        <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                                        <button onclick="decrease('#product_price',true)" class="btn btn-primary btn-square bootstrap-touchspin-down touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-minus"></i></button>
                                        <button onclick="increase('#product_price',true)" class="btn btn-primary btn-square bootstrap-touchspin-up touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-plus"></i></button>
                                        <button onclick="increase('#product_price',true,0.1)" class="btn btn-custom-width btn-primary btn-square bootstrap-touchspin-down touchspin-btn" type="button" data-bs-original-title="" title="">0.1</i></button>
                                        <button onclick="increase('#product_price',true,0.01)" class="btn btn-custom-width btn-primary btn-square bootstrap-touchspin-up touchspin-btn" type="button" data-bs-original-title="" title="">0.01</button>
                                    </div>
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-xxl-4 col-xl-12 col-md-12 mb-3">
                                    <input type="file" class="form-control" name="product_image" id="add_product_image" accept="image/*" />
                                </div>

                            </div>
                            <div class="row mb-2">
                                <div class="col-7 text-end">
                                    <span type="button" class="text-danger btn-reset">Reset</span>
                                </div>
                                <div class="col-5 text-left">
                                    <span type="button" class="text-danger btn-advance"><i class="fa fa-plus"></i> Advance</span>
                                </div>
                            </div>
                            <div id="advance_options" class="row d-none">
                                <div class="col-lg-6 mb-3  d-md-flex">
                                    <select name="country" class="country-list col-sm-12 @error('country') is-invalid @enderror" aria-placeholder="Choose Country">
                                        <option value="" selected>Item Made From</option>
                                        @foreach ($countries as $country)
                                        <option value="{{$country->name}}" {{$country->name == old('country') ?'selected':''}} data-icon="fi-{{strtolower($country->sortname)}}">{{$country->name}}</option>

                                        @endforeach
                                    </select>

                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-xxl-3 col-6 d-flex  field-area">
                                    <div class="offer-price-checkbox text-nowrap">
                                        <div>
                                            <input type="checkbox" id="offer-price-id" name="is_offer">
                                            <label for="offer-price-id" style="font-size: 12px; color: #898989">Offer Price</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xxl-3 col-6 d-flex  field-area">
                                    <div class="duty-free-checkbox text-nowrap">
                                        <div>
                                            <input type="checkbox" id="duty-free-id" name="is_duty_free">
                                            <label for="duty-free-id" style="font-size: 12px; color: #898989">Duty Free</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-align-right text-sm-end">
                            <button class="btn d-md-none" type="button" onclick="$('.product-form-area').toggleClass('d-block')">Cancel</button>
                            <button class="btn btn-primary" id="add_product_btn">Add Product</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- new product form end -->
            <!-- product cards view start -->
            <div class="product_list_grid">
                @include('products.partials.product-list')
            </div>
            <!-- product cards view end -->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

@endsection
@section('modals')
@include('partials.modals.add-category')
@include('partials.modals.add-shop')
@include('partials.modals.edit-product')
@include('partials.modals.clone-product')
@include('partials.modals.bulk-upload')
@endsection
