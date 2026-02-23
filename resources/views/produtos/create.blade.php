@extends('layouts.app')

@section('content')
<h3>Novo Produto</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-2">
        <input type="text" name="nome" class="form-control" placeholder="Nome do produto" value="{{ old('nome') }}" required>
    </div>

    <div class="mb-2">
        <input type="text" name="preco" id="preco" class="form-control" placeholder="Preço (R$)" value="{{ old('preco') }}" required>
    </div>

    <div class="mb-2">
        <input type="number" name="quantidade" class="form-control" placeholder="Quantidade" value="{{ old('quantidade') }}" required>
    </div>

    <div class="mb-2">
        <textarea name="descricao" class="form-control" placeholder="Descrição">{{ old('descricao') }}</textarea>
    </div>

    <div class="mb-2">
        <label>Imagem (jpg, jpeg, png | max 2MB)</label>
        <input type="file" name="imagem" class="form-control" accept=".jpg,.jpeg,.png" onchange="previewImage(event)">
    </div>

    <div class="mb-2">
        <img id="preview" src="#" style="display:none; max-width:150px; margin-top:10px;">
    </div>

    <button class="btn btn-success">Salvar Produto</button>
</form>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}

// ==============================
// Formatação BRL correta
// ==============================
const precoInput = document.getElementById('preco');

precoInput.addEventListener('input', function(e) {
    let value = e.target.value;

    // Remove tudo que não seja número
    value = value.replace(/\D/g, '');

    if (!value) {
        e.target.value = '';
        return;
    }

    // Garante pelo menos 1 centavo
    if (value.length === 1) value = '01';
    if (value.length === 2) value = value;

    let integerPart = value.slice(0, -2) || '0';
    let decimalPart = value.slice(-2);

    // Remove zeros à esquerda da parte inteira
    integerPart = integerPart.replace(/^0+/, '') || '0';

    // Formata milhar com ponto
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    e.target.value = integerPart + ',' + decimalPart;
});

// Antes de enviar, converte para float do backend (1.300,20 -> 1300.20)
document.querySelector('form').addEventListener('submit', function(e) {
    let val = precoInput.value.replace(/\./g, '').replace(',', '.');
    precoInput.value = val;
});
</script>

@endsection