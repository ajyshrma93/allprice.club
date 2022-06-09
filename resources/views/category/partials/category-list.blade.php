<div class="col-12">
    <div class="product-wrapper-grid" id="category-list">
        <div class="row">
            @forelse ($categories as $category)

            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="product-box">
                        <div class="product-img" style="background-image: url('{{asset($category->image)}}');background-size: 100% 100%;">
                            <div class="product-hover">
                                <ul>
                                    <li>
                                        <button class="btn" type="button" data-url="{{route('category.edit',$category->id)}}" data-bs-toggle="modal" data-bs-target="#editcategory">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                                                <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                            </svg>
                                        </button>
                                    </li>
                                    <li class="bg-danger">
                                        <form method="POST" action="{{route('category.destroy',$category->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn delete-product" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                </svg>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-details text-center ">
                            <h4>{{$category->name}}</h4>
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
