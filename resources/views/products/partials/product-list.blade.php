<div class="col-12">
    <div class="row product-wrapper-grid">

        @forelse ($products as $product)
        @include('products.partials.single-product')
        @empty
        <img src="{{asset('assets/images/no-data-found.png')}}" alt="product image">
        @endforelse


    </div>
</div>
