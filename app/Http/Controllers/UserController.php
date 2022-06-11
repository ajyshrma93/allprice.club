<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function __construct()
    {

        view()->share('menu', 'users');
    }

    public function index()
    {
        $users = User::where('role_id', User::ROLE_USER)->get();

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            $user->products()->delete();
        }

        Session::flash('success', 'User has been deleted successfully');
        return redirect()->back();
    }
}
