@extends('layouts.app')

@section('content')
<h3>Produtos</h3>

<div class="mb-3 d-flex justify-content-between flex-wrap">
    <a href="{{ route('produtos.create') }}" class="btn btn-success mb-2">Novo Produto</a>

    {{-- Filtro e busca --}}
    <form method="GET" class="d-flex gap-2 mb-2 align-items-center">
        <input type="text" name="search" placeholder="Buscar por nome" class="form-control" value="{{ request('search') }}">
        <input type="number" name="min_price" placeholder="Preço mínimo" class="form-control" step="0.01" value="{{ request('min_price') }}">
        <input type="number" name="max_price" placeholder="Preço máximo" class="form-control" step="0.01" value="{{ request('max_price') }}">
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Limpar</a>
    </form>
</div>

<table class="table table-striped table-hover align-middle">
    <thead class="table-dark text-center">
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($produtos as $produto)
        <tr>
            <td class="text-center">
                @if($produto->imagem)
                    <img src="{{ asset('storage/'.$produto->imagem) }}" alt="{{ $produto->nome }}" class="img-thumbnail" style="width:70px; height:70px; object-fit:cover;">
                @else
                    <span class="text-muted">Sem imagem</span>
                @endif
            </td>
            <td>{{ $produto->nome }}</td>
            <td>R$ {{ number_format($produto->preco,2,",",".") }}</td>
            <td class="text-center">{{ $produto->quantidade }}</td>
            <td class="text-center">
                <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('produtos.destroy', $produto) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este produto?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center text-muted">Nenhum produto encontrado</td>
        </tr>
        @endforelse
    </tbody>
</table>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const alerts = document.querySelectorAll('.alert');

    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }, 3000);
    });
});
</script>

@endsection
