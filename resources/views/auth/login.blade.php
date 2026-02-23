@extends('layouts.app')

@section('content')

<style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: 
            linear-gradient(rgba(255,255,255,0.65), rgba(255,255,255,0.65)),
            url("{{ asset('images/sp.png') }}") no-repeat center center fixed;
        background-size: cover;
    }

    /* ALERTA GLOBAL VERDE CLARO */
    .global-alert {
        position: fixed;
        top: 30px;
        left: 50%;
        transform: translateX(-50%);
        min-width: 350px;
        max-width: 500px;
        text-align: center;
        background: #4caf50; /* verde claro */
        color: white;
        padding: 18px 30px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 500;
        box-shadow: 0 15px 40px rgba(0,0,0,0.25);
        z-index: 9999;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        padding: 40px;
        border-radius: 20px;
        background: rgba(255,255,255,0.95);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        color: #333;
    }

    .login-card h3 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
        color: #1a2a44;
    }

    .form-control {
        border-radius: 12px;
        padding: 14px;
        border: 1px solid #ddd;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 10px rgba(0,123,255,0.3);
    }

    .btn-login {
        width: 100%;
        border-radius: 12px;
        padding: 14px;
        font-weight: bold;
        background: #007bff;
        border: none;
        color: #fff;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: #0056b3;
        transform: scale(1.03);
    }

    .alert {
        font-size: 14px;
        border-radius: 10px;
        text-align: center;
    }

    .link-register { 
        text-decoration: none; 
        font-weight: 500; 
        color: #007bff; 
    }
    
    .link-register:hover { 
        text-decoration: none; 
        color: #0056b3; 
    }
</style>

{{-- SUCESSO GLOBAL (fora da caixa) --}}
@if(session()->has('success'))
    <div class="global-alert" id="globalSuccess">
        {{ session()->pull('success') }}
    </div>
@endif

<div class="login-container">
    <div class="login-card">

        <h3>🔐 Login</h3>

        {{-- ERRO DENTRO DA CAIXA --}}
        @if(session('login_error'))
            <div class="alert alert-danger" id="loginAlert">
                {{ session('login_error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Digite seu e-mail"
                       value="{{ old('email') }}"
                       required>
            </div>

            <div class="mb-3">
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Digite sua senha"
                       required>
            </div>

            <button type="submit" class="btn btn-login">
                Entrar
            </button>
            
            <div class="text-center mt-3"> 
                <a href="{{ route('register') }}" class="link-register"> 
                    Registrar-se 
                </a> 
            </div>
        </form>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    function autoHide(id) {
        let el = document.getElementById(id);
        if (el) {
            setTimeout(function () {
                el.style.transition = "opacity 0.5s";
                el.style.opacity = "0";
                setTimeout(() => el.remove(), 500);
            }, 3000);
        }
    }

    autoHide("globalSuccess");  // sucesso grande fora da caixa
    autoHide("loginAlert");     // erro dentro da caixa

});
</script>

@endsection