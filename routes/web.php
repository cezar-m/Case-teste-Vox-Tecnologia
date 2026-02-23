<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================
// ROTA INICIAL
// =========================
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// =========================
// AUTENTICAÇÃO (PÚBLICAS)
// =========================
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout (precisa estar logado)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// =========================
// ROTAS PROTEGIDAS (LOGADO)
// =========================
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // =========================
    // PRODUTOS (USUÁRIO LOGADO)
    // =========================
    Route::resource('produtos', ProdutoController::class);

    // =========================
    // ROTAS ADMIN
    // =========================
    Route::middleware('can:admin-only')->group(function () {

        // Listar usuários
        Route::get('/usuarios', [UserController::class, 'index'])
            ->name('users.index');

        // Deletar usuário
        Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');
    });
});
