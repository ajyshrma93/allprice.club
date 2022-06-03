@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-5">
                    <h3>Purchase On {{$product->created_at->format('Y-m-d')}}</h3>
                </div>
                <div class="col-7">
                    <div class="create-new-items justify-content-end">
                        <a href="{{route('reports.index')}}" class="btn btn-sm btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- API-3 start -->
            <div class="card">
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
            </div>
            <!-- API-3 end -->
        </div>
    </div>
</div>
@endsection
