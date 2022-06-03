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
        $products = $products->whereYear('created_at', date('Y'));
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

    public function details(Request $request)
    {
        $products = Product::where('created_at', 'like', '%' . $request->date . '%')->where([
            'user_id' => auth()->id(),
            'shop_id' => $request->shop_id
        ])->get();

        $html = '';

        foreach ($products as $product) {
            $html .= '<tr><td><img src="' . $product->thumbnail . '" width="100" height="100"/></td><td>' . $product->name . '</td><td> RM ' . $product->getPrice() . '</td></tr>';
        }


        return response()->json(['html' => $html]);
    }
}
