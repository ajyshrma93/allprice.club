<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
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
        $locations = City::get();
        $shops = Shop::get();
        $categories = Category::get();
        $products = Product::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('products.index', compact('products', 'countries', 'categories', 'shops', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }
        try {
            $product = new Product();
            $product = $this->setProductAttribute($product, $request);
            $product->save();

            $html = view('products.partials.single-product', compact('product'))->render();

            $response['html'] = $html;
            $response['message'] = 'Product Added successfully';
            $response['success'] = true;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
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
        $validator = $this->validateRequest($request);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }
        $product = Product::findOrFail($request->product_id);
        try {
            $product = $this->setProductAttribute($product, $request, 'update');
            $product->save();
            $html = $this->getProductListHtml();

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
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }
        $oldProduct = Product::findOrFail($request->product_id);
        try {
            $product = new Product();
            $product = $this->setProductAttribute($product, $request);
            if (!$request->has('product_image')) {
                $product->image = $oldProduct->image;
                $product->thumbnail = $oldProduct->thumbnail;
            }
            $product->save();
            $html = $this->getProductListHtml();

            $response['html'] = $html;
            $response['message'] = 'Product cloned  successfully';
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

    public function bulkUpload(Request $request)
    {
        $rules = [
            'shop_id' => 'required',
            'product_images' => 'required',
            'product_images.*' => 'mimes:jpeg,png,jpg|max:2048'
        ];
        $messages = [
            'shop_id.required' => 'Please select a shop'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }
        try {
            $files = $request->file('product_images');
            foreach ($files as $key => $file) {
                $product = new Product();
                $product->price = 1.00;
                $product->name = 'Product ' . ++$key;
                $product->type = 'pcs';
                $product->value = '1';
                $product->shop_id = $request->shop_id;
                $product->category_id = $request->category_id;
                $product->user_id = auth()->id();

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
                $product->save();
            }
            $html = $this->getProductListHtml();

            $response['html'] = $html;
            $response['message'] = 'Product uploaded successfully';
            $response['success'] = true;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getProductListHtml()
    {
        $products = Product::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        $html =  view('products.partials.product-list', compact('products'))->render();
        return $html;
    }


    protected function validateRequest(Request $request)
    {
        $rules = [
            'category_id' => 'required',
            'shop_id' => 'required',
            'name' => 'required',
            'value' => 'required|gt:0',
            'price' => 'required|gt:0',
            'type' => 'required'
        ];
        $messages = [
            'category_id.required' => 'Please select a category',
            'shop_id.required' => 'Please select a shop',
            'name.required' => 'Product name is required field',
            'value.required' => 'This field is requierd'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        return  $validator;
    }


    protected function setProductAttribute($product, $request, $type = 'add')
    {
        $product->name = $request->name;
        $product->price = $request->price;
        $product->is_offer = $request->is_offer ? 1 : 2;
        $product->is_duty_free = $request->is_duty_free ? 1 : 2;
        $product->value = $request->value;
        $product->shop_id = $request->shop_id;
        $product->category_id = $request->category_id;
        $product->type = $request->type;
        $product->country = $request->country;
        $product->location = $request->location;

        if ($type == 'add') {
            $product->image = 'assets/images/no-data-available.png';
            $product->thumbnail = 'assets/images/no-data-available.png';
            $product->user_id = auth()->id();
        }
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

        return $product;
    }
}
