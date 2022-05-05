<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Validator;


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
        $countries = Country::orderBy('sort', 'desc')->get();
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
            $product->image = 'assets/images/no-data-available.png';
            $product->thumbnail = 'assets/images/no-data-available.png';
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
                $img->resize(150, 150, function ($const) {
                    $const->aspectRatio();
                })->save(storage_path('app/' . $filePath));
                $product->thumbnail =  str_replace('public', 'storage', $filePath);
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
     * @return \Illuminate\Http\Response
     */
    public function ajaxUpdate(Request $request)
    {
        $rules = [
            'category_id' => 'required',
            'shop_id' => 'required',
            'name' => 'required',
            'country' => 'required',
            'value' => 'required|min:0.1',
            'price' => 'required|min:0.1',
            'edit_type' => 'required'
        ];
        $messages = [
            'category_id.required' => 'Please select a category',
            'shop_id.required' => 'Please select a shop',
            'name.required' => 'Product name is required field',
            'country.required' => 'Please select product country',
            'value.required' => 'This field is requierd'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }
        $product = Product::findOrFail($request->product_id);
        try {
            $product->name = $request->name;
            $product->price = $request->price;
            $product->is_offer = $request->is_offer ? 1 : 0;
            $product->value = $request->value;
            $product->shop_id = $request->shop_id;
            $product->category_id = $request->category_id;
            $product->type = $request->edit_type;
            $product->country = $request->country;
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
                $img->resize(150, 150, function ($const) {
                    $const->aspectRatio();
                })->save(storage_path('app/' . $filePath));
                $product->thumbnail =  str_replace('public', 'storage', $filePath);
            }
            $product->save();
            $products = Product::where('user_id', auth()->id())->get();
            $html = view('products.partials.product-list', compact('products'))->render();

            $response['html'] = $html;
            $response['message'] = 'Product Update successfully';
            $response['success'] = true;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clone(Request $request)
    {
        $rules = [
            'category_id' => 'required',
            'shop_id' => 'required',
            'name' => 'required',
            'country' => 'required',
            'value' => 'required|min:0.1',
            'price' => 'required|min:0.1',
            'clone_type' => 'required'
        ];
        $messages = [
            'category_id.required' => 'Please select a category',
            'shop_id.required' => 'Please select a shop',
            'name.required' => 'Product name is required field',
            'country.required' => 'Please select product country',
            'value.required' => 'This field is requierd'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }
        $oldProduct = Product::findOrFail($request->product_id);
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->is_offer = $request->is_offer ? 1 : 0;
            $product->value = $request->value;
            $product->shop_id = $request->shop_id;
            $product->category_id = $request->category_id;
            $product->type = $request->clone_type;
            $product->country = $request->country;
            if ($request->has('product_image')) {
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
                $img->resize(150, 150, function ($const) {
                    $const->aspectRatio();
                })->save(storage_path('app/' . $filePath));
                $product->thumbnail =  str_replace('public', 'storage', $filePath);
            } else {
                $product->image = $oldProduct->image;
                $product->thumbnail = $oldProduct->thumbnail;
            }
            $product->save();
            $products = Product::where('user_id', auth()->id())->get();
            $html = view('products.partials.product-list', compact('products'))->render();

            $response['html'] = $html;
            $response['message'] = 'Product Update successfully';
            $response['success'] = true;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
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
                Storage::delete($product->image);
                return response()->json(['success' => true, 'product_id' => $product->id, 'message' => 'Product has been deleted successfully']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Something went wrong. While deleteing product']);
    }
}
