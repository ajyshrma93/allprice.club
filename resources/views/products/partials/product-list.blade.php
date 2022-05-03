<div class="col-12">
    <div class="product-wrapper-grid">
        <div class="row">

            @forelse ($products as $product)
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="ribbon ribbon-info ribbon-right">{{$product->value}} {{$product->type}}</div>
                            <img src="{{asset($product->image)}}" alt="product image">
                            <div class="product-hover">
                                <ul>
                                    <li>
                                        <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#editProductModal">
                                            <i data-feather="edit"></i>
                                        </button>
                                    </li>
                                    <li class="bg-primary">
                                        <button class="btn text-white" type="button" data-bs-toggle="modal" data-bs-target="#product-modal-3">
                                            <i data-feather="plus"></i>
                                        </button>
                                    </li>
                                    <li class="bg-info">
                                        <a href="{{asset($product->image)}}" data-lightbox="product-image" data-title="Beautiful Lamp" data-alt="full view" class="btn text-white">
                                            <i data-feather="eye"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
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
