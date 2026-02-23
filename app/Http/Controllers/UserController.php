<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function destroy(User $user)
    {
        $admin = Auth::user();
        if($admin->role !== 'admin') {
            abort(403, 'Ação não permitida');
        }

        // Impede que o admin exclua a si mesmo
        if($user->id === $admin->id) {
            return back()->with('error', 'Você não pode excluir a si mesmo.');
        }

        $user->delete();
        return back()->with('success', 'Usuário excluído com sucesso.');
    }
}
