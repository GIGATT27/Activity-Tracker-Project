<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'username' => ['required',Rule::unique('users','username')],
            'full_name' => ['required'],
            'email' => ['required',Rule::unique('users','email')],
            'phone' => ['required'],
            'password' => ['required',Rule::unique('users','password')],
            // $password => ['required',Rule::unique('users','password')],

        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/Home');
        

    }


    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);
    
        // Find the user by their username
        $user = User::where('username', $incomingFields['loginname'])->first();
    
        if (!$user || !Hash::check($incomingFields['loginpassword'], $user->password)) {
            // Invalid credentials, redirect back to login page with an error message
            return redirect('/')->with('error', 'Invalid username or password');
        }
    
        // Authentication successful
        auth()->login($user);
        $request->session()->regenerate();
    
        return redirect('/Home');
    }
    
    public function logout(Request $request) {
        auth()->logout();
        return redirect('/');
    }
}
