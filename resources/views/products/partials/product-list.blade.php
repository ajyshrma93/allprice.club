<div class="col-12">
    <div class="row product-wrapper-grid">
        @php
        $allName=[];
        @endphp
        @forelse ($products as $product)
        <?php
        if ($product->name) {
            if (in_array($product->name, $allName)) {
                continue;
            }
            $allName[] = $product->name;
        }
        ?>
        @include('products.partials.single-product')
        @empty
        <img src="{{asset('assets/images/no-data-found.png')}}" alt="product image" id="empty_product_image">
        @endforelse


    </div>
</div>
