<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendWelcomeEmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home')->with('success', 'You have been logged out.');
    }

    public function authenticate(LoginRequest $request)
    {
        $request->validated();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->status === false) {
                Auth::logout();

                return redirect()->route('login')->withErrors([
                    'email' => 'Your account is inactive. Please contact the administrator.',
                ])->onlyInput('email');
            }

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'You are logged in as Admin!');
            }

            return redirect()->route('user.dashboard')->with('success', 'You are logged in as User!');

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function store(RegisterRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user', // Default role is user
            'status' => true, // Default status is active
        ]);

        SendWelcomeEmailJob::dispatch($user);

        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', 'Registration successful! Welcome to DigiGo.');
    }
}
