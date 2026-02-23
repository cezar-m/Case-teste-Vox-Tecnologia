@extends('layouts.app')

@section('content')

<h3>Dashboard</h3>

<p>Olá, {{ $user->name }} ({{ ucfirst($user->role) }})</p>

{{-- ALERTA GLOBAL SUCESSO --}}
@if(session()->has('success'))
    <div class="alert global-alert alert-success" id="globalSuccess">
        {{ session()->pull('success') }}
    </div>
@endif

<h4>Meus Produtos</h4>
<a href="{{ route('produtos.create') }}" class="btn btn-success mb-2">Novo Produto</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
        <tr>
            <td>
                @if($produto->imagem)
                    <img src="{{ asset('storage/'.$produto->imagem) }}" width="80">
                @endif
            </td>
            <td>{{ $produto->nome }}</td>
            <td>R$ {{ number_format($produto->preco,2,",",".") }}</td>
            <td>{{ $produto->quantidade }}</td>
            <td>
                <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('produtos.destroy', $produto) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Apenas admins veem os usuários --}}
@if($user->role === 'admin')
    <h4 class="mt-4">Usuários</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ ucfirst($u->role) }}</td>
                <td>
                    {{-- Só admin pode deletar usuários --}}
                    @if($user->role === 'admin' && $u->id !== $user->id)
                        <form action="{{ route('users.destroy', $u) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

<style>
/* ALERTA GLOBAL CENTRAL */
.global-alert {
    position: fixed;
    top: 30px;
    left: 50%;
    transform: translateX(-50%);
    min-width: 350px;
    max-width: 500px;
    text-align: center;
    padding: 18px 30px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 500;
    box-shadow: 0 15px 40px rgba(0,0,0,0.25);
    z-index: 9999;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let success = document.getElementById("globalSuccess");
    if(success) {
        setTimeout(function () {
            success.style.transition = "opacity 0.5s";
            success.style.opacity = "0";
            setTimeout(() => success.remove(), 500);
        }, 3000);
    }

});
</script>

@endsection
