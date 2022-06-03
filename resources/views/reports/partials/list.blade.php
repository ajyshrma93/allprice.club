@foreach ($products as $product)
@php
$shop = $product->shop;
$image = $shop ? $shop->image :'assets/images/no-data-available.png';
@endphp
<div class="col-xl-3 col-sm-6 col-6">
    <div class="card">
        <div class="product-box">
            <a href="{{route('reports.details',$product->id)}}">

                <div class="product-img" style="background-image: url('{{asset($image)}}');background-size: 100% 100%;">
                    <div class="ribbon ribbon-info ribbon-right">{{$product->total_items}} Items</div>
                    <div class="product-hover">

                    </div>
                </div>
            </a>
            <div class="product-details">
                <h4>{{ $shop ? $shop->name :'N/A'}}</h4>
                <div class="product-price"> RM {{$product->total_price}}<br />
                    <span>{{$product->created_at->format('d/m/Y')}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
