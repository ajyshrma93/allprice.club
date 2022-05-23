@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-5">
                    <h3>Cities</h3>
                </div>
                <div class="col-7">
                    <div class="create-new-items justify-content-end">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#add_city_modal" data-bs-original-title="" title="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg> <span class="me-2">Add City</span>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- API-3 start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="cityDatatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>City Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- API-3 end -->
        </div>
    </div>
</div>
@endsection
@section('modals')
@include('partials.modals.add-city')
@include('partials.modals.edit-city')
@endsection

@push('scripts')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script>
    let $table = $('#cityDatatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('cities.list') }}",
            type: 'POST',
            data: {
                '_token': '<?= csrf_token() ?>'
            }
        },
        columns: [{
                data: 'id',
                name: 'id',
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            },
        ],
    });

    $("body").on("click", "#ajax_add_city_button", function() {
        clearError();
        let Modal = $("#add_city_modal");
        var fdata = new FormData();
        var myform = $("#ajax_add_city"); // specify the form element
        let action = myform.attr("action");
        var idata = myform.serializeArray();
        $.each(idata, function(key, input) {
            fdata.append(input.name, input.value);
        });
        $.ajax({
            url: action,
            data: fdata,
            method: "POST",
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success == true) {
                    $table.draw();
                    Modal.modal('hide');
                    hideloader();
                }
            },
            error: function(e) {

                if (e.status === 422) {
                    var response = $.parseJSON(e.responseText);
                    $.each(response.errors, function(key, val) {
                        Modal
                            .find('[name="' + key + '"]')
                            .addClass("is-invalid");
                        Modal
                            .find('[name="' + key + '"]')
                            .parent()
                            .append(
                                ' <span class="invalid-feedback" role="alert"><strong>' +
                                val +
                                "</strong></span>"
                            );
                    });
                }
                hideloader();
            },
        });
    });

    $("#edit_city_modal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var url = button.data("href"); // Extract info from data-* attributes
        var id = button.data("id"); // Extract info from data-* attributes
        var name = button.data("name"); // Extract info from data-* attributes

        var modal = $(this);
        modal.find('input[name="name"]').val(name);
        modal.find('input[name="id"]').val(id);
        modal.find('form').attr('action', url);
    });

    $("body").on("click", "#ajax_edit_city_button", function() {
        clearError();
        let Modal = $("#edit_city_modal");
        var fdata = new FormData();
        var myform = $("#ajax_edit_city"); // specify the form element
        let action = myform.attr("action");
        var idata = myform.serializeArray();
        $.each(idata, function(key, input) {
            fdata.append(input.name, input.value);
        });
        $.ajax({
            url: action,
            data: fdata,
            method: "POST",
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success == true) {
                    $table.draw();
                    Modal.modal('hide');
                    hideloader();
                }
            },
            error: function(e) {

                if (e.status === 422) {
                    var response = $.parseJSON(e.responseText);
                    $.each(response.errors, function(key, val) {
                        Modal
                            .find('[name="' + key + '"]')
                            .addClass("is-invalid");
                        Modal
                            .find('[name="' + key + '"]')
                            .parent()
                            .append(
                                ' <span class="invalid-feedback" role="alert"><strong>' +
                                val +
                                "</strong></span>"
                            );
                    });
                }
                hideloader();
            },
        });
    });
</script>
@endpush
