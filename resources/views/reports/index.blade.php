@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-5">
                    <h3>Reports</h3>
                </div>
                <div class="col-7">
                    <div class="create-new-items justify-content-end">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- API-3 start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-lg-start justify-content-center mb-3">
                            <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10">
                                <label>Select Date to Filter :</label>
                                <div class="input-group">
                                    <input class=" form-control" type="text" data-language="en" id="date" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div id="Chart">
                            @include('reports.partials.list')
                        </div>
                    </div>
                </div>
            </div>
            <!-- API-3 end -->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
@push('css')
<style>
    .day {
        padding: 8px;
    }
</style>
@endpush

@section('modals')
<div class="modal fade" id="purchase_details" tabindex="-1" aria-labelledby="add_shop_modal-mobile" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3 p-0 d-flex flex-column align-items-start">
                <h4 class="modal-title"><a href="#" data-bs-original-title="" title="">Purchase Details</a></h4>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                            </tr>
                        <tbody>

                        </tbody>
                        </thead>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
    $('#date').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
    }).on('change', function() {
        var date = $(this).val();
        $.ajax({
            url: '{{route("reports.filter")}}',
            data: {
                date: date
            },
            method: 'POST',
            success: function(response) {
                if (response.success == true) {
                    $('#Chart').html(response.html);
                }
            }
        })
    });

    $('#purchase_details').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var shop_id = button.data('shop') // Extract info from data-* attributes
        var date = button.data('date') // Extract info from data-* attributes
        var modal = $(this)
        $.ajax({
            url: '{{route("reports.details")}}',
            data: {
                shop_id: shop_id,
                date: date
            },
            method: 'POST',
            success: function(response) {
                $('tbody').html(response.html);
            }
        })
    })
</script>
@endpush
