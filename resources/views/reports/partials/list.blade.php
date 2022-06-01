@foreach ($products as $product)
@php
$date= $product->created_at->format('Y-m-d');
@endphp
<div class="row p-1">
    <div class="col-12">
        <button class="btn btn-primary" data-shop="{{$product->shop_id}}" data-date="{{$date}}" data-bs-toggle="modal" data-bs-target="#purchase_details">
            <?= \App\Models\Product::where('user_id', auth()->id())->whereDate('created_at', $product->created_at)->count() ?> Item
        </button>
        | RM (<?= \App\Models\Product::where('user_id', auth()->id())->whereDate('created_at', $product->created_at)->sum('price') ?>)
        | Shop : {{$product->shop ? $product->shop->name :''}}
        {{$product->created_at}}
    </div>
</div>
@endforeach
