<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        view()->share('menu', 'product');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::get();
        $shops = Shop::get();
        $categories = Category::get();
        $products = Product::where('user_id', auth()->id())->get();
        return view('products.index', compact('products', 'countries', 'categories', 'shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'shop_id' => 'required',
            'name' => 'required',
            'country' => 'required',
            'value' => 'required|min:0.1',
            'price' => 'required|min:0.1'
        ], [
            'category_id.required' => 'Please select a category',
            'shop_id.required' => 'Please select a shop',
            'name.required' => 'Product name is required field',
            'country.required' => 'Please select product country',
            'value.required' => 'This field is requierd'
        ]);

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->is_offer = $request->is_offer ? 1 : 0;
            $product->value = $request->value;
            $product->shop_id = $request->shop_id;
            $product->category_id = $request->category_id;
            $product->type = $request->type;
            $product->user_id = auth()->id();
            $product->country = $request->country;
            $product->image = 'assets/images/no-data-available.jpg';
            $product->thumbnail = 'assets/images/no-data-available.jpg';
            if ($request->has('product_image') && $request->file != 'undefined') {


                $file = $request->file('product_image');
                $fileName = Str::random(20) . '_' . $file->getExtension();
                $filePath = $file->storeAs('uploads/products/', $fileName, 'public');
                $product->image = 'storage/' . $filePath;

                // save thumbnail
                $path =  'public/uploads/products/thumbnail/';
                @mkdir(storage_path('app/' . $path), 0777);
                $name = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $filePath = $path . $name;
                $img = Image::make($file->path());
                $img->resize(110, 110, function ($const) {
                    $const->aspectRatio();
                })->save(storage_path('app/' . $filePath));
                $product->thumbnail = 'storage/' . $filePath;
            }
            $product->save();
            Session::flash('success', 'Product has been added successfully');
            return back();
        } catch (\Exception $e) {
            Session::flash('success', 'Something went wrong. While adding product');

            return back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data['success'] = true;
        $data['product'] = $product;

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->user_id = auth()->id()) {
            if ($product->delete()) {

                return response()->json(['success' => true, 'product_id' => $product->id, 'message' => 'Product has been deleted successfully']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Something went wrong. While deleteing product']);
    }
}
