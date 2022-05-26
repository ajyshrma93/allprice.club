<?php

namespace App\Http\Controllers;

use App\Models\City;
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

    public function compareLocation(Request $request)
    {
        $is_changed = false;
        $location = City::where('name', $request->location)->first();
        if ($location) {
            if ($location->name != auth()->user()->location) {
                $is_changed = true;
            }
        }

        return response()->json(['is_changed' => $is_changed]);
    }

    public function updateLocation(Request $request)
    {
        $user = auth()->user();
        $user->location = $request->location;
        $user->save();
        return response()->json(['success' => true]);
    }
}
