@extends('layouts.app')

@section('content')
<h3>Cadastro de Usuário</h3>

@if(session('success'))
    <div class="alert alert-success" id="alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger" id="alert-errors">
        @foreach($errors->all() as $erro)
            <div>{{ $erro }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('register.post') }}" method="POST">
    @csrf

    <div class="mb-2">
        <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ old('name') }}" required>
    </div>

    <div class="mb-2">
        <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" required>
    </div>

    <div class="mb-2">
        <input type="password" name="password" class="form-control" placeholder="Senha" required>
    </div>

    <div class="mb-2">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme a senha" required>
    </div>

    <div class="mb-2">
        <label>Tipo de usuário</label>
        <select name="role" class="form-control" required>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuário</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
        </select>
    </div>

    <button class="btn btn-success">Cadastrar</button>
</form>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Desaparecer alertas após 3 segundos
    setTimeout(() => {
        const success = document.getElementById('alert-success');
        if(success) success.style.display = 'none';

        const errors = document.getElementById('alert-errors');
        if(errors) errors.style.display = 'none';
    }, 3000);
});
</script>
@endsection
