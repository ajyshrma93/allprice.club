<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __construct()
    {
        view()->share('menu', 'search');
    }

    public function index(Request $request, $type)
    {
        $shops = Shop::get();
        $categories = Category::get();
        $products = Product::paginate(10);
        return view('search.index', compact('products', 'categories', 'shops'));
    }
}
