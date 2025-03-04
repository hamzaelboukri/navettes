<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  
    public function show()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role = Role::find($user->role_id);

            if ($role && $role->name === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($role && $role->name === 'user') {
                return redirect()->intended('/user/dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account does not have access.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials. Please check your email and password.',
        ]);
    }

    // Handle user logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}