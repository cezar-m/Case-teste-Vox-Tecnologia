@extends('layouts.app')

@section('content')
<h3>{{ isset($produto) ? 'Editar Produto' : 'Novo Produto' }}</h3>

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

<form action="{{ isset($produto) ? route('produtos.update', $produto) : route('produtos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($produto))
        @method('PUT')
    @endif

    <div class="mb-2">
        <input type="text" name="nome" class="form-control" placeholder="Nome do produto" value="{{ old('nome', $produto->nome ?? '') }}" required>
    </div>

    <div class="mb-2">
        <input type="text" name="preco" id="preco" class="form-control" placeholder="Preço (R$)" 
               value="{{ old('preco', isset($produto) ? number_format($produto->preco, 2, ',', '.') : '') }}" required>
    </div>

    <div class="mb-2">
        <input type="number" name="quantidade" class="form-control" placeholder="Quantidade" value="{{ old('quantidade', $produto->quantidade ?? '') }}" required>
    </div>

    <div class="mb-2">
        <textarea name="descricao" class="form-control" placeholder="Descrição">{{ old('descricao', $produto->descricao ?? '') }}</textarea>
    </div>

    <div class="mb-2">
        <label>Imagem (jpg, jpeg, png, avif | max 2MB)</label>
        <input type="file" name="imagem" class="form-control" accept=".jpg,.jpeg,.png,.avif" onchange="previewImage(event)">
    </div>

    <div class="mb-2">
        <img id="preview" src="{{ isset($produto) && $produto->imagem ? asset('storage/'.$produto->imagem) : '#' }}" 
             style="display: {{ isset($produto) && $produto->imagem ? 'block' : 'none' }}; max-width:150px; margin-top:10px;">
    </div>

    <button class="btn btn-success">{{ isset($produto) ? 'Atualizar Produto' : 'Salvar Produto' }}</button>
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
// Formatação de preço BRL sem zeros extras
// ==============================
const precoInput = document.getElementById('preco');

precoInput.addEventListener('input', function(e) {
    let value = e.target.value;

    // Remove tudo que não seja número
    value = value.replace(/\D/g, '');

    if(!value) {
        e.target.value = '0,00';
        return;
    }

    // Sempre garante pelo menos 3 dígitos para separar decimal
    while(value.length < 3) value = '0' + value;

    let integerPart = value.slice(0, -2);
    let decimalPart = value.slice(-2);

    // Remove zeros à esquerda da parte inteira
    integerPart = integerPart.replace(/^0+(?!$)/, '');

    // Formata milhar
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    e.target.value = integerPart + ',' + decimalPart;
});

// ==============================
// Converter preço para float antes do submit
// ==============================
document.querySelector('form').addEventListener('submit', function(e) {
    let val = precoInput.value.replace(/\./g, '').replace(',', '.');
    precoInput.value = val;
});
</script>
@endsection
