@extends('layouts.custom')
@section('header')
<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="left-header col-auto horizontal-wrapper ps-0">
            <ul>
                <a href="{{route('reports.index')}}" class="btn btn-sm btn-primary">Back</a>
            </ul>
        </div>
        <div class="nav-right col-6 pull-right right-header  ms-auto">
            <ul class="nav-menus me-0">
                <li>
                    <h3> RM : {{$products->sum('price')}}</h3>
                </li>
            </ul>
        </div>

    </div>
</div>

@endsection
@section('content')
<div class="page-body">
    <div class="container-fluid mt-5">
        <div class="page-title ">
            <div class="row mt-2">
                <div class="col-7">
                    <h3>{{$shop->name}}</h3>

                </div>
                <div class="col-5">
                    <h5>{{$product->created_at->format('Y-m-d')}}</h5>
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
                                    <div class="product-img" style="background-image: url({{asset($product->thumbnail)}});background-size: 100% 100%;">
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
