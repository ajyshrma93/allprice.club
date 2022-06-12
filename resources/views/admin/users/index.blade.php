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
                            <table class="display table" id="cityDatatable">
                                <thead>
                                    <tr>
                                        <!-- <th>#</th> -->
                                        <th>User </th>
                                        <th>Purchases</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <!-- <td>{{$loop->iteration}}</td> -->
                                        <td>{{$user->name}}<br />{{$user->email}}</td>
                                        <td>{{$user->products()->count()}}</td>
                                        <td>
                                            <form action="{{route('users.destroy', $user->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE" data-bs-original-title="" title="">
                                                @csrf
                                                <a class="btn btn-danger btn-sm delete-product"><i class="fa fa-trash"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
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
