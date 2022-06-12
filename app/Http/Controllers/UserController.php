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
    public function updatePublicStatus(Request $request)
    {
        $user = auth()->user();
        if ($user->is_public) {
            $message = 'Your purchases will be no more publicly shared';
        } else {
            $message = 'You have successfully shared you purchases publicly';
        }
        $user->is_public = $user->is_public ? 0 : 1;
        $user->save();
        return response()->json(['success' => true, 'message' => $message]);
    }
}
