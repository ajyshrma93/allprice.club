@extends('layouts.custom')
@section('header')
<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="{{url('/home')}}">
                    <img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}" alt="">
                </a>
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
        </div>
        <div class="left-header col-auto horizontal-wrapper ps-0">
            <ul>
                <a href="{{route('reports.index')}}" class="btn btn-sm btn-primary">Back</a>
            </ul>
        </div>
        <div class="nav-right col-6 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus me-0">
                <li>

                </li>
            </ul>
        </div>

    </div>
</div>

@endsection
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-7">
                    <h3>{{$shop->name}}<br /> {{$product->created_at->format('Y-m-d')}}</h3>
                </div>
                <div class="col-5">
                    <div class="create-new-items justify-content-end">
                        <h3> RM : {{$products->sum('price')}}</h3>
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
                <div class="product-wrapper-grid">
                    <div class="row">
                        @forelse ($products as $product)
                        <div class="col-xl-3 col-sm-6" id="product_box_{{$product->id}}">
                            <div class="card">
                                <div class="product-box">
                                    <div class="product-img" style="background-image: url({{asset($product->image)}});background-size: 100% 100%;">
                                        <div class="ribbon ribbon-info ribbon-right">{{$product->getPrice()}}</div>
                                    </div>
                                    <div class="product-details">
                                        <h4>{{$product->name}}</h4>
                                        <div class="product-price">${{$product->price}}
                                            <span class="text-end" style="float: right;">{{$product->value}} {{$product->type}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <img src="{{asset('assets/images/no-data-found.png')}}" alt="product image">
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- API-3 end -->
        </div>
    </div>
</div>
@endsection
