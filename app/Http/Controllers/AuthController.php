<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function show(){
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'telephone' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'address' => $request->address,
            'role_id' => 1, // Default role_id for a regular user
        ]);

        Auth::login($user);

        $adminExists = User::where('role_id', 2)->exists();
        if (!$adminExists) {
            $adminRole = Role::find(2); 
            if ($adminRole) {
                $user->role_id = $adminRole->id;
                $user->save();
                return redirect('/admin/dashboard');
            }
        }

        return redirect('/user/dashboard');
    }

    public function showUserDashboard()
    {
        return view('user.dashboard');
    }

    public function showAdminDashboard()
    {
        if (Auth::user()->role_id !== 2) {
            return redirect('/user/dashboard')->with('error', 'Unauthorized access');
        }

        $users = User::with('role')->get();
        return view('admin.dashboard', compact('users'));
    }

    public function updateUserRole(Request $request, $id)
    {
        if (Auth::user()->role_id !== 2) {
            return redirect()->back()->with('error', 'Unauthorized action');
        }

        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully');
    }
}