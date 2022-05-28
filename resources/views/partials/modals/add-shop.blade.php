<div class="modal fade" id="add_shop_modal" tabindex="-1" role="dialog" aria-labelledby="add_shop_modal-mobile" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3 p-0 d-flex flex-column align-items-start">
                <h4 class="modal-title"><a href="#">Add New Shop</a></h4>
            </div>
            <form action="{{route('shops.store')}}" class="theme-form" id="ajax_add_shop" onsubmit=" event.preventDefault()">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-form-label pt-0">Shop Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Shop Name" data-bs-original-title="" id="shop_name_input">
                        <span id="shop_name_error" class=" invalid-feedback"></span>
                    </div>
                    <div class="col-md-12">
                        <label class="col-form-label pt-0">Location</label>
                        <select name="city_id" class="form-control select2" id="shop_city_id_input">
                            <option value="">Select Location</option>
                            @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                        <span id="shop_city_id_error" class=" invalid-feedback"></span>
                    </div>
                    <div class="col-md-12 mt-md-0 mt-3">
                        <label class="col-form-label pt-0">Shop Image</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="shop_image" id="add_shop_image" id="select-file" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 text-center text-sm-end ps-0 pe-0">
                    <button class="btn" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary me-0" id="ajax_add_shop_button">Add shop</button>
                </div>
            </form>

        </div>
    </div>
</div>
