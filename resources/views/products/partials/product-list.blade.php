<div class="col-12">
    <div class="product-wrapper-grid">
        <div class="row">

            @forelse ($products as $product)
            <div class="col-xl-3 col-sm-6" id="product_box_{{$product->id}}">
                <div class="card">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="ribbon ribbon-info ribbon-right">{{$product->value}} {{$product->type}}</div>
                            <img src="{{asset($product->image)}}" alt="product image">
                            <div class="product-hover">
                                <ul>
                                    <li>
                                        <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#editProductModal" data-destroy="{{route('products.destroy',$product->id)}}" data-url="{{route('products.edit',$product->id)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                                                <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                            </svg>
                                        </button>
                                    </li>
                                    <li class="bg-primary">
                                        <button class="btn text-white" type="button" data-bs-toggle="modal" data-bs-target="#cloneProductModal" data-url="{{route('products.edit',$product->id)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </button>
                                    </li>
                                    <li class="bg-info">
                                        <a href="{{asset($product->image)}}" data-lightbox="product-image" data-title="Beautiful Lamp" data-alt="full view" class="btn text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
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