<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Shop;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        view()->share('menu', 'home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function getLocation(Request $request)
    {
        return view('geolocation');
    }

    public function compareLocation(Request $request)
    {
        $is_changed = false;
        $city = City::where('name', $request->place)->first();
        if ($city) {
            if ($city->id != auth()->user()->city_id) {
                $is_changed = true;
            }
        }


        return response()->json(['is_changed' => $is_changed]);
    }

    public function updateLocation(Request $request)
    {
        $response['success'] = false;
        $city = City::where('name', $request->place)->first();
        if ($city) {
            $user = auth()->user();
            $user->city_id = $city->id;
            $user->save();

            $response['success'] = true;
            $response['shops'] = Shop::where('city_id', $city->id)->pluck('name', 'id');
        }

        return response()->json($response);
    }
}
