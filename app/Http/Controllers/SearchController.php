<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __construct()
    {
        view()->share('menu', 'search');
    }

    public function index(Request $request, $type)
    {

        return view('search.index');
    }
}
