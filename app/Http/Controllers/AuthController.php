<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        // if (Auth::check()) {
        //     return redirect()->route('admin-dashboard');
        // }
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:4|confirmed'
            ]
        );
        $user=new User($request->all());
    }

    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required|min:4'
            ]
        );

        $credentials = $request->only('email', 'password');

        $remember = $request->has('remember_me');

        if (Auth::attempt($credentials, $remember)) {
                return redirect()->route('user-profile');
            
            //return redirect()->route('admin-dashboard');
        }

        return back()->with('auth_error', 'Invalid credentials')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login-form');
    }
}
