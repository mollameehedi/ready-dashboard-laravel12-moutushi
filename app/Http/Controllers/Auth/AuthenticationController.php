<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(){
        if(Auth::check()){
          return redirect()->intended('/home');
        }else{
            return view('auth.login');
        }
    }
    public function login_submit(Request $request)
     {
        $this->validate($request, [
            'number' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'number' => $request->number,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/home'); // Change '/dashboard' to your desired redirect
        }
        throw ValidationException::withMessages([
            'login' => [trans('auth.failed')],
        ]);
    }
}
