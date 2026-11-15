<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login', ['title' => 'Masuk']);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->isAdmin()) {
                return redirect()->intended('/admin')->with('success', 'Selamat datang kembali, Admin ' . $user->name . '!');
            }

            return redirect()->intended('/')->with('success', 'Selamat datang kembali, ' . $user->name . '!');
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'Email atau kata sandi tidak cocok.',
        ]);
    }

    public function showRegister(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register', ['title' => 'Gabung Komunitas']);
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama'                  => 'required|string|min:2|max:60',
            'email'                 => 'required|string|email|max:120|unique:users,email',
            'password'              => 'required|string|min:8|confirmed',
        ], [
            'nama.required'      => 'Nama harus diisi.',
            'email.required'     => 'Email harus diisi.',
            'email.unique'       => 'Email sudah terdaftar. Silakan login.',
            'password.required'  => 'Kata sandi harus diisi.',
            'password.min'       => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::create([
            'name'     => $validated['nama'],
            'email'    => strtolower($validated['email']),
            'password' => Hash::make($validated['password']),
            'role'     => 'member',
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Selamat bergabung di Halowan.id, ' . $user->name . '!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Kamu sudah keluar.');
    }
}
