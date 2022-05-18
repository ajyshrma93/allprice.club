<?php

namespace App\Http\Controllers;

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


    public function getLocation()
    {
        $ip = request()->ip();
        $ip = '117.215.245.92';
        $userLocation = Location::get($ip);

        return view('geolocation', compact('userLocation'));
    }
}
