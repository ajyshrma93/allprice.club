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
        $products = Product::paginate(8);
        return view('search.index', compact('products', 'categories', 'shops'));
    }

    public function filter(Request $request)
    {
        $products = Product::orderBy('id', 'desc');
        if ($request->category_id) {
            $products = $products->where('category_id', $request->category_id);
        }
        if ($request->shop_id) {
            $products = $products->where('shop_id', $request->shop_id);
        }
        $products = $products->paginate(8);
        $html = view('search.partials.list', compact('products'))->render();
        $response['success'] = true;
        $response['html'] = $html;

        return response()->json($response, 200);
    }
}
