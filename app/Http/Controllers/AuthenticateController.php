<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    public function doRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]); 

        $postVal['name'] = $request->name;
        $postVal['email'] = $request->email;
        $postVal['is_admin'] = 0;
        $postVal['phone'] = $request->phone;
        $postVal['password'] = Hash::make($request->password);
        $create =  User::create($postVal);
        if ($create) {
            return redirect()->route('login');
        } else {
            return redirect()->back()
                ->withErrors('Register akun gagal.');
        }
    }
    public function doLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            return redirect()->route('home');
        } else {
            return redirect()->back()
                ->withErrors('Email-Address And Password Are Wrong.');
        }
    }

    public function doLogout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
