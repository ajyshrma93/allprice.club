@extends('layouts.app')


@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-5">
                    <h3>Shop List</h3>
                </div>
                <div class="col-7">
                    <div class="create-new-items justify-content-end">
                        <button class="btn btn-primary d-flex " type="button" data-bs-toggle="modal" data-bs-target="#add_shop_modal" data-bs-original-title="" title="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <span class="ms-2">Add New Shop</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">

            <!-- product cards view start -->
            @include('shop.partials.shop-list')
            <!-- product cards view end -->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection

@section('modals')
@include('partials.modals.add-shop')
@include('partials.modals.edit-shop')
@endsection
