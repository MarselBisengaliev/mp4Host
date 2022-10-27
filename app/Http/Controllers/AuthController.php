<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register() {
        return view('auth.register');
    }

    public function login() {
        return view('auth.login');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }

    public function authorization(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
            LoginHistory::create(Auth::id());
            return redirect()->route('home', ['message' => 'Вы успешно авторизоавлись']);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function registration(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $validated = $validator->validated();

        $user = User::create(
            $validated['name'],
            $validated['email'],
            Hash::make($validated['password'])
        );

        Auth::login($user, true);
        LoginHistory::create($user->id);

        event(new Registered($user));

        return redirect()->route('verification.notice');
    }
}
