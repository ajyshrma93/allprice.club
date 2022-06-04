<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        view()->share('menu', 'reports');
    }

    public function index(Request $request)
    {

        $products = Product::select(['products.*', DB::Raw('sum(`price`) total_price'), DB::Raw('count(*) total_items'), DB::Raw('DATE(created_at) day')])->where('user_id', auth()->id())->groupBy('shop_id', 'day');
        $date = date('Y-m');
        $products = $products->where('created_at', 'like', '%' . $date . '%');
        $products = $products->get();
        return view('reports.index', compact('products'));
    }

    public function filter(Request $request)
    {
        $products = Product::select(['products.*', DB::Raw('sum(`price`) total_price'), DB::Raw('count(*) total_items'), DB::Raw('DATE(created_at) day')])->where('user_id', auth()->id())->groupBy('shop_id', 'day');
        if ($request->date) {
            $date = date('Y-m', strtotime($request->date));
            $products = $products->where('created_at', 'like', '%' . $date . '%');
        }
        $products = $products->get();
        $html = view('reports.partials.list', compact('products'))->render();

        return response()->json(['success' => true, 'html' => $html]);
    }

    public function details($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $products = Product::where('shop_id', $product->shop_id)->whereDate('created_at', $product->created_at->format("Y-m-d"))->get();
        return view('reports.details', compact('products', 'product'));
    }
}
