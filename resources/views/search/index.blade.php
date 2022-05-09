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

                        <a class="d-md-none" type="button" data-bs-toggle="modal" data-bs-target="#product-modal-2-mobile" data-bs-original-title="" title="">
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
                    <div class="row theme-form d-none d-md-flex">
                        <div class="col-xl-3 col-md-6 mb-lg-3 mb-2">
                            <input type="search" class="form-control py-2" placeholder="Search by products name" data-bs-original-title="" title="">
                        </div>
                        <div class="col-xl-3 col-md-6 mb-lg-3 mb-2">
                            <select class="form-control  col-sm-12 select2-basic">
                                <option value="1" selected="">All Shop</option>
                                @foreach ($shops as $shop)
                                <option value="{{$shop->id}}">{{$shop->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-lg-3 mb-2">
                            <select class="form-control  col-sm-12 select2-basic">
                                <option value="" selected="">All Category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-lg-3 mb-2">
                            <select class="form-control col-sm-12 select2-basic">
                                <option value="" selected="">Select Offer</option>
                                <option value="1">Yes</option>
                                <option value="2">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="product_list_grid">
                            @include('search.partials.list')
                        </div>
                        {{ $products->appends(request()->input())->links() }}
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
            <form class="theme-form">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <select class=" col-sm-12" id="modalSelect-01">
                                <option value="">All Category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <select class=" col-sm-12" id="modalSelect-02">
                                <option value="">All Shop</option>
                                @foreach ($shops as $shop)
                                <option value="{{$shop->id}}">{{$shop->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer border-0 text-center text-sm-end pe-0 ps-0">
                <button class="btn" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary me-0">Apply</button>
            </div>
        </div>
    </div>
</div>
@endsection
