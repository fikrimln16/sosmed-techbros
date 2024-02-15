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
            'name' => 'required|string|min:8|max:255',
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

    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleCallback()
    {
        $githubUser = Socialite::driver('github')->user();
        // dd($githubUser);
        // Cek apakah pengguna sudah terdaftar dalam database
        $user = User::where('email', $githubUser->email)->first();
        // dd($githubUser);

        // Jika belum, tambahkan pengguna ke dalam database
        if (!$user) {
            $user = new User();
            $user->provider_id = $githubUser->id;
            $user->nickname = $githubUser->nickname;
            $user->name = $githubUser->name;
            $user->email = $githubUser->email;
            $user->avatar = $githubUser->avatar;
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