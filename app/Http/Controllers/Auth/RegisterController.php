<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Create a new user instance
        User::create([
            'name' => $request->name,
            'email' => $request->email
            'password' => Hash::make($request->password), // Hash the password
        ]);
        
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registration successful! You are now logged in.');
    }
}
