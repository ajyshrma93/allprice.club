<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        view()->share('menu', 'category');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('category.index', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories,name'
        ], [
            'name.required' => 'Category name is required',
            'name.unique' => 'Category with this name already exists'
        ]);
        $data['user_id'] = auth()->id();

        try {
            if ($request->file('category_image')) {
                $file = $request->file('category_image');
                $fileName = Str::random(20) . '_' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads/category', $fileName, 'public');
                $data['image'] = 'storage/' . $filePath;
            } else {
                $data['image'] = 'assets/images/no-data-available.png';
            }
            Category::create($data);
            Session::flash('success', 'Category has been created successfuly');
        } catch (\Exception $e) {
            dd($e);
        }

        return redirect(route('category.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $response['success'] = true;
        $response['data'] = $category->toArray();
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
        $data = $request->validate([
            'name' => 'required|unique:categories,name,' . $request->id,
        ], [
            'name.required' => 'Category name is required',
            'name.unique' => 'Category with this name already exists'
        ]);
        $category = Category::findOrfail($request->id);

        try {
            if ($request->file('category_image')) {
                Storage::disk('public')->delete(str_replace('storage', '', $category->image));
                $file = $request->file('category_image');
                $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads/category', $fileName, 'public');
                $data['image'] = 'storage/' . $filePath;
            }

            $category->update($data);
            $response['success'] = true;
            $categories  = Category::get();
            $response['html'] = view('category.partials.category-list', compact('categories'))->render();
        } catch (\Exception $e) {
            $response['status'] = false;
            $response['message'] = $e->getMessage();
        }


        return response()->json($response);
    }


    public function ajaxAdd(Request $request)
    {
        $rules = [
            'name' => 'required|unique:categories,name,'
        ];
        $messages = [
            'name.required' => 'Category name is required',
            'name.unique' => 'Category with this name already exists'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 400);
        }
        $category = new Category();
        $category->name = $request->name;
        $image  = 'assets/images/no-data-available.png';

        if ($request->file('category_image')) {
            $file = $request->file('category_image');
            $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/category', $fileName, 'public');
            $image = 'storage/' . $filePath;
        }
        $response = [];
        $category->image = $image;
        $category->user_id = auth()->id();
        if ($category->save()) {
            $response['success'] = true;
            $response['message'] = 'Catgeory has been created successfully';
            $response['data'] = $category;

            $categories  = Category::get();
            $response['html'] = view('category.partials.category-list', compact('categories'))->render();
        } else {
            $response['success'] = false;
            $response['message'] = 'Something went wrong.While creating category';
        }

        return response()->json($response);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            Storage::disk('public')->delete(str_replace('storage', '', $category->image));
            Session::flash('success', 'Category has been deleted successfully');
        }

        return back();
    }
}
