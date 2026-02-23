<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',
        'quantidade',
        'descricao',
        'imagem',
        'user_id'
    ];

    // Relacionamento: produto pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
