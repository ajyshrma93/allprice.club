<div class="modal fade" id="add_catgeory_modal" tabindex="-1" role="dialog" aria-labelledby="add_catgeory_modal-mobile" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3 p-0 d-flex flex-column align-items-start">
                <h4 class="modal-title"><a href="#">Add New Category</a></h4>
                <span>Please fill up the form below to add new Category</span>
            </div>
            <form action="{{route('category.ajax-add')}}" class="theme-form" id="ajax_add_category" onsubmit=" event.preventDefault()">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-form-label pt-0">Category Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Category" data-bs-original-title="" id="category_name_input">
                        <span id="category_name_error" class=" invalid-feedback"></span>
                    </div>
                    <div class="col-md-12 mt-md-0 mt-3">
                        <label class="col-form-label pt-0">Category Image</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="category_image" id="add_category_image" id="select-file" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 text-center text-sm-end ps-0 pe-0">
                    <button class="btn" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary me-0" id="ajax_add_category_button">Add Category</button>
                </div>
            </form>

        </div>
    </div>
</div>
