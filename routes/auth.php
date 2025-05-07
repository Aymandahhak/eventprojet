<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

// Routes d'authentification

// Inscription
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect('/dashboard');
})->middleware('guest');

// Connexion
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
    ])->onlyInput('email');
})->middleware('guest');

// Déconnexion
Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');