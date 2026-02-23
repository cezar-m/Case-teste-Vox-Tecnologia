<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Produto;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Todos veem seus próprios produtos
        $produtos = Produto::where('user_id', $user->id)->get();

        // Apenas admin vê a lista de usuários
        $usuarios = [];
        if ($user->role === 'admin') {
            $usuarios = User::all();
        }

        return view('dashboard.index', compact('produtos', 'usuarios', 'user'));
    }
}
