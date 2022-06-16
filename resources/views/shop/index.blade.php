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
                            <!-- <span class="ms-2">Add New</span> -->
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-xl-6  mb-3 col-xxl-7 col-xl-6 col-md-8 col-12">
                        <select class="form-select select2" id="filter_shop">
                            <option value="">All Location</option>
                            @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- product cards view start -->
            <div id="shops_list">
                @include('shop.partials.shop-list')
            </div>
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


@push('scripts')
<script>
    $('#filter_shop').change(function() {
        let location_id = $(this).val();

        $.ajax({
            url: '{{route("shops.filter")}}',
            data: {
                location_id: location_id
            },
            method: "POST",
            success: function(response) {
                $('#shops_list').html(response.html);
            }
        })
    })
</script>
@endpush
