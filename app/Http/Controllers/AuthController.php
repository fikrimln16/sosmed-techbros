<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function show(){
        return view('pages.login');
    }

    public function show_register(){
        return view('pages.register');
    }

    public function store_register(Request $request){
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Buat user baru
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'avatar' => 'https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario'
        ]);
    
        return redirect()->route('login-page');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Cek apakah pengguna sudah terdaftar dalam database
        $user = User::where('google_id', $googleUser->id)->first();
        // dd($googleUser);

        // Jika belum, tambahkan pengguna ke dalam database
        if (!$user) {
            $user = new User();
            $user->google_id = $googleUser->getId();
            $user->name = $googleUser->getName();
            $user->email = $googleUser->getEmail();
            $user->avatar = $googleUser->getAvatar();
            $user->email_verified_at = now(); // Sesuaikan dengan cara verifikasi email di aplikasi Anda
            $user->password = ''; // Jika menggunakan OAuth, password tidak digunakan
            $user->save();
        }

        // Login pengguna
        Auth::login($user);

        // Redirect ke halaman setelah login
        return redirect()->route('dashboard')->with('success', 'Berhasil Login!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('dashboard')->with('success', 'Berhasil Logout');
    }
}