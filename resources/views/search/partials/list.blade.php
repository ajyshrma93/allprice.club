<div class="col-12">
    <div class="product-wrapper-grid">
        <div class="row">

            @forelse ($products as $product)
            <div class="col-xl-3 col-sm-6" id="product_box_{{$product->id}}">
                <div class="card">
                    <div class="product-box">
                        <div class="product-img" style="background-image: url({{asset($product->image)}});background-size: 100% 100%;">
                            <div class="ribbon ribbon-info ribbon-right">RM {{$product->getPrice()}}</div>
                        </div>
                        <div class="product-details">
                            <h4>{{$product->name}}</h4>
                            <div class="product-price">RM {{$product->price}}
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
@if($products->count() > 0)
<nav>
    <ul class="pagination mb-4">

        @if($products->currentPage() == 1)
        <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
            <span class="page-link" aria-hidden="true">‹‹ Previous</span>
        </li>
        @else
        <li class="page-item ">
            <a class="page-link" href="javascript:void(0)" data-page="{{$products->currentPage() - 1}}" rel="next" aria-label="Next »" data-bs-original-title="" title="">‹‹ Previous</a>
        </li>
        @endif
        <li class="page-item active" aria-current="page"><span class="page-link" data-page="{{$products->currentPage()}}">{{$products->currentPage()}}</span></li>
        @if($products->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="javascript:void(0)" data-page="{{$products->currentPage() + 1}}" rel="next" aria-label="Next »" data-bs-original-title="" title="">Next ››</a>
        </li>
        @else
        <li class="page-item disabled" aria-disabled="true" aria-label="Next ››">
            <span class="page-link" aria-hidden="true">Next ››</span>
        </li>
        @endif
    </ul>
</nav>
@endif
