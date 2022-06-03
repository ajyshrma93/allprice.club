<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __construct()
    {
        view()->share('menu', 'search');
    }

    public function index(Request $request)
    {
        $shops = Shop::get();
        $categories = Category::get();
        $locations = City::get();
        $products = Product::orderByDesc('id')->paginate(8);
        return view('search.index', compact('products', 'categories', 'shops', 'locations'));
    }

    public function filter(Request $request)
    {
        $products = Product::query();
        if ($request->name) {
            $products = $products->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->category_id) {
            $products = $products->where('category_id', $request->category_id);
        }
        if ($request->shop_id) {
            $products = $products->where('shop_id', $request->shop_id);
        }
        if ($request->created_at) {
            $products = $products->where('created_at', 'like', '%' . $request->created_at . '%');
        }
        if ($request->is_offer) {
            $products = $products->where('is_offer', 1);
        }
        if ($request->is_duty_free) {
            $products = $products->where('is_duty_free', 1);
        }
        if ($request->location_id) {
            $products = $products->wherehas('shop', function ($query) use ($request) {
                $query->where('city_id', $request->location_id);
            });
        }
        if ($request->sort) {
            $products = $products->orderBy('price', $request->sort);
        }

        $products = $products->paginate(8);
        $html = view('search.partials.list', compact('products'))->render();
        $response['success'] = true;
        $response['html'] = $html;

        return response()->json($response, 200);
    }
}
