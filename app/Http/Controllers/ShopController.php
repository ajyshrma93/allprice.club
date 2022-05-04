<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function __construct()
    {

        view()->share('menu', 'shop');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::get();
        return view('shop.index', compact('shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:shops,name,'
        ];
        $messages = [
            'name.required' => 'Shop name is required',
            'name.unique' => 'Shop with this name already exists'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 400);
        }

        $shop = new Shop();
        $shop->name = $request->name;
        $shop->user_id = auth()->user()->id;
        $shop->image = 'assets/images/no-data-available.png';
        if ($request->file('shop_image')) {
            $file = $request->file('shop_image');
            $fileName = Str::random(20) . '_' . $file->getExtension();
            $filePath = $file->storeAs('uploads/shop', $fileName, 'public');
            $shop->image = 'storage/' . $filePath;
        }

        if ($shop->save()) {
            $response['success'] = true;
            $shops  = Shop::get();
            $response['data'] = $shop;
            $response['html'] = view('shop.partials.shop-list', compact('shops'))->render();
        } else {
            $response['success'] = false;
        }


        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $response['success'] = true;
        $response['data'] = $shop->toArray();
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxUpdate(Request $request)
    {
        $rules = [
            'name' => 'required|unique:shops,name,' . $request->id
        ];
        $messages = [
            'name.required' => 'Shop name is required',
            'name.unique' => 'Shop with this name already exists'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 400);
        }
        $shop = Shop::findOrFail($request->id);
        $shop->name = $request->name;
        $shop->user_id = auth()->user()->id;
        if ($request->file('shop_image')) {
            Storage::delete($shop->image);
            $file = $request->file('shop_image');
            $fileName = Str::random(20) . '_' . $file->getExtension();
            $filePath = $file->storeAs('uploads/shop', $fileName, 'public');
            $shop->image = 'storage/' . $filePath;
        }

        if ($shop->save()) {
            $response['success'] = true;
            $shops  = Shop::get();
            $response['html'] = view('shop.partials.shop-list', compact('shops'))->render();
        } else {
            $response['success'] = false;
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        if ($shop->delete()) {
            Session::flash('success', 'Shop has been deleted successfully');
        } else {
            Session::flash('error', 'Something went wrong. While deleteing shop');
        }

        return back();
    }
}
