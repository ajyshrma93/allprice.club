<div class="modal fade" id="add_city_modal" tabindex="-1" role="dialog" aria-labelledby="add_catgeory_modal-mobile" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3 p-0 d-flex flex-column align-items-start">
                <h4 class="modal-title"><a href="#">Add New City</a></h4>
            </div>
            <form action="{{route('cities.store')}}" class="theme-form" id="ajax_add_city" onsubmit=" event.preventDefault()">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-form-label pt-0">City Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Enter City Name" data-bs-original-title="" id="city_name_input">
                    </div>
                </div>
                <div class="modal-footer border-0 text-center text-sm-end ps-0 pe-0">
                    <button class="btn" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary me-0" id="ajax_add_city_button">Add City</button>
                </div>
            </form>

        </div>
    </div>
</div>
