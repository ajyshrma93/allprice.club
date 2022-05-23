<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        view()->share('menu', 'cities');
    }
    public function index(Request $request)
    {
        return view('admin.cities.index');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:cities,name']);

        $city = new City();
        $city->name = $request->name;
        if ($city->save()) {
            return response()->json(['success' => true], 200);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:cities,name,' . $request->id
        ]);
        $city = City::findOrFail($request->id);
        $city->name = $request->name;
        if ($city->save()) {
            return response()->json(['success' => true], 200);
        }
    }


    public function getList(Request $request)
    {

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = City::select('count(*) as allcount')->count();
        $totalRecordswithFilter = City::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = City::orderBy($columnName, $columnSortOrder)
            ->where('name', 'like', '%' . $searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {


            $data_arr[] = array(
                "id" => $record->id,
                "name" => $record->name,
                "action" => '<button data-bs-toggle="modal" data-bs-target="#edit_city_modal" data-id="' . $record->id . '" data-name="' . $record->name . '"  class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>'
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }
}
