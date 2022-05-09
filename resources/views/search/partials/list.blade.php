<div class="col-12">
    <div class="product-wrapper-grid">
        <div class="row">

            @forelse ($products as $product)
            <div class="col-xl-3 col-sm-6" id="product_box_{{$product->id}}">
                <div class="card">
                    <div class="product-box">
                        <div class="product-img" style="background-image: url({{asset($product->image)}});background-size: 100% 100%;">
                            <div class="ribbon ribbon-info ribbon-right">{{$product->value}} {{$product->type}}</div>
                        </div>
                        <div class="product-details">
                            <h4>{{$product->name}}</h4>
                            <div class="product-price">${{$product->price}}</div>
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
