@foreach ($products as $product)
@php
$shop = $product->shop;
@endphp
<div class="col-xl-3 col-sm-6">
    <div class="card">
        <div class="product-box">
            <div class="product-img" style="background-image: url('{{asset($shop->image)}}');background-size: 100% 100%;">
                <div class="ribbon ribbon-info ribbon-right">{{$product->total_items}} Items</div>
                <div class="product-hover">

                </div>
            </div>
            <div class="product-details">
                <h4>{{$shop->name}}</h4>
                <div class="product-price">
                    $ {{$product->total_price}}
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
