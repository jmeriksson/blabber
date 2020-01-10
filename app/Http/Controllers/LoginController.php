<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class LoginController extends Controller
{
    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $usernameExistsQuery =
        "SELECT *
        FROM authors
        WHERE username = '{$request->input('username')}'";
        $usernameExists = DB::select($usernameExistsQuery);

        if(count($usernameExists) == 0) {
            return redirect('/login')->with('error', "Username {$request->input('username')} is not registered");
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        } else {
            return 'did not pass';
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->intended('/');
    }
}
