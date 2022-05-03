@extends('layouts.app')


@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-5">
                    <h3>Category List</h3>
                </div>
                <div class="col-7">
                    <div class="create-new-items justify-content-end">
                        <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="modal" data-bs-target="#add_catgeory_modal">
                            <i data-feather="plus"></i>
                            <span class="ms-2">Add New Category</span>
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
            <div class="col-12 d-none d-md-flex w-100">
                <div class="card w-100">
                    <div class="card-header">
                        <h5><a href="#">Add new Category</a></h5>
                        <span>Please fill up the form below to add new Category</span>
                    </div>
                    <form method="POST" action="{{route('category.store')}}" class="theme-form" enctype="multipart/form-data">

                        <div class="card-body">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-form-label pt-0">Enter Category</label>
                                        <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Category">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-md-0 mt-3">
                                        <label class="col-form-label pt-0">Category Image</label>
                                        <div class="input-group">
                                            <input type="file" name="category_image" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                            <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon04">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center text-sm-end">
                            <button type="submit" class="btn btn-primary">Add Category</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- new product form end -->

            <!-- product cards view start -->
            @include('category.partials.category-list')
            <!-- product cards view end -->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

@endsection

@section('modals')

@include('partials.modals.add-category')
@include('partials.modals.edit-category')

@endsection
