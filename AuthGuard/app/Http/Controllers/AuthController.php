<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use http\QueryString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request) {

        $username = $request->input('username');
        $password = $request->input('password');

        $credentials = [
            'username' => $username,
            'password' => $password,
        ];

        if (Auth::validate($credentials)) {

            $user = Auth::user();
            $username = Auth::id();

            $request->session()->put('lifeTime', Carbon::now()->timestamp);

            return redirect('profile');

        } else {
            echo 'Well, There is an issue with provided credentials :(';
        }
    }

    public function profile()
    {
        return view('auth.profile');
    }

}
