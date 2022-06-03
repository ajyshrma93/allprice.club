@extends('layouts.app')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-10 col-md-5">
                    <h3>Public List (Grid view)</h3>
                </div>
                <div class="col-2 col-md-7">
                    <div class="create-new-items justify-content-end">

                        <a class="" type="button" data-bs-toggle="modal" data-bs-target="#product-modal-2-mobile" data-bs-original-title="" title="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- product cards view start -->
            <div class="col-12 card-body">
                <div class="product-wrapper-grid">
                    <div class="row">
                        <div class="product_list_grid">
                            @include('search.partials.list')
                        </div>

                    </div>
                </div>
            </div>
            <!-- product cards view end -->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection

@section('modals')
<div class="modal fade" id="product-modal-2-mobile" tabindex="-1" role="dialog" aria-labelledby="product-modal-2-mobile" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3 p-0">
                <h4 class="modal-title"><a href="#">Filter</a></h4>
                <!-- <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <form class="theme-form" id="gridSearchForm" action="{{route('filter-products')}}">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <input name="name" class="form-control" placeholder="Search by product name" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <select name="category_id" class=" col-sm-12" id="modalSelect-01">
                                <option value="">All Category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <select name="shop_id" class=" col-sm-12" id="modalSelect-02">
                                <option value="">All Shop</option>
                                @foreach ($shops as $shop)
                                <option value="{{$shop->id}}">{{$shop->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <input name="created_at" class="form-control" type="date" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <select name="location_id" class=" col-sm-12" id="modalSelect-02">
                                <option value="">All Location</option>
                                @foreach ($locations as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
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
                    <div class="col-12">
                        <div class="mb-3">
                            <select name="sort" class=" col-sm-12" id="modalSelect-02">
                                <option value="">Select </option>
                                <option value="asc">Lowest to Highest </option>
                                <option value="desc">Highest to Lowest </option>

                            </select>
                        </div>
                    </div>

                </div>
            </form>
            <div class="modal-footer border-0 text-center text-sm-end pe-0 ps-0">
                <button class="btn" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary me-0" id="applyFilter">Apply</button>
            </div>
        </div>
    </div>
</div>
@endsection
