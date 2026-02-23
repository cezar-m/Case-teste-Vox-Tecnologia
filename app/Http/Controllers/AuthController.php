<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // =========================
    // FORM LOGIN
    // =========================
    public function showLogin()
    {
        return view('auth.login');
    }

    // =========================
    // LOGIN
    // =========================
    public function login(Request $request)
    {
        // Validação manual sem usar withErrors
        if (!$request->email || !$request->password) {
            return back()
                ->withInput()
                ->with('login_error', 'Preencha todos os campos.');
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return back()
                ->withInput()
                ->with('login_error', 'Informe um e-mail válido.');
        }

        if (strlen($request->password) < 6) {
            return back()
                ->withInput()
                ->with('login_error', 'A senha deve ter no mínimo 6 caracteres.');
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()
            ->withInput()
            ->with('login_error', 'E-mail ou senha inválidos.');
    }

    // =========================
    // FORM REGISTER
    // =========================
    public function showRegister()
    {
        return view('auth.register');
    }

    // =========================
    // REGISTER
    // =========================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')
            ->with('success', 'Usuário criado com sucesso!');
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Logout realizado com sucesso.');
    }
}