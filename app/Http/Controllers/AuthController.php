<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Societe;
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
            'role' => 'required|string|in:client,soigneur' // Updated role names
        ]);
        
        // Create user in `users` table with role directly
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role  // Store role name directly
        ]);
        
        if ($request->role === 'client') {
            Client::create([
                'id' => $user->id,
                'telephone' => $request->telephone ?? null,
                'address' => $request->address ?? null,
            ]);
            
            Auth::login($user);
            return redirect('/pageclient'); 
        } 
        elseif ($request->role === 'soigneur') {
            Societe::create([
                'name' => $request->name,
                'description' => $request->description ?? '',
                'address' => $request->address ?? '',
                'Telephone' => $request->telephone ?? null,
                'user_id' => $user->id 
            ]);
            
            Auth::login($user);
            return redirect('/societe'); 
        }
        
        // Default redirect for admin or other roles
        Auth::login($user);
        return redirect('/dashboard'); 
    }
}