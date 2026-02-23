<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produto;

class ProdutoController extends Controller
{
    // =========================
    // FUNÇÃO AUXILIAR: CONVERTE PREÇO BR PARA FLOAT
    // =========================
    private function converterPrecoBrParaFloat($preco_br)
    {
        return str_replace(',', '.', str_replace('.', '', $preco_br));
    }

    // =========================
    // LISTAR PRODUTOS COM FILTROS
    // =========================
    public function index(Request $request)
    {
        $query = Produto::where('user_id', Auth::id());

        // Filtro por nome
        if ($request->filled('search')) {
            $query->where('nome', 'like', '%' . $request->search . '%');
        }

        // Filtro por preço mínimo
        if ($request->filled('min_price')) {
            $query->where('preco', '>=', $this->converterPrecoBrParaFloat($request->min_price));
        }

        // Filtro por preço máximo
        if ($request->filled('max_price')) {
            $query->where('preco', '<=', $this->converterPrecoBrParaFloat($request->max_price));
        }

        $produtos = $query->orderBy('nome')->get();

        return view('produtos.index', compact('produtos'));
    }

    // =========================
    // FORM CREATE
    // =========================
    public function create()
    {
        return view('produtos.create');
    }

    // =========================
    // SALVAR PRODUTO
    // =========================
    public function store(Request $request)
    {
        // Converte preço BR -> float
        if ($request->filled('preco')) {
            $request->merge(['preco' => $this->converterPrecoBrParaFloat($request->preco)]);
        }

        // Validação
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0.01',
            'quantidade' => 'required|integer|min:0',
            'descricao' => 'nullable|string',
        ], [
            'nome.required' => 'O campo Nome é obrigatório.',
            'preco.required' => 'O campo Preço é obrigatório.',
            'preco.numeric' => 'O Preço deve ser um número.',
            'preco.min' => 'O Preço deve ser maior que zero.',
            'quantidade.required' => 'O campo Quantidade é obrigatório.',
            'quantidade.integer' => 'A Quantidade deve ser um número inteiro.',
        ]);

        $data = $request->only('nome', 'preco', 'quantidade', 'descricao');

        // Upload de imagem
        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }

        $data['user_id'] = Auth::id();

        Produto::create($data);

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto criado com sucesso!');
    }

    // =========================
    // FORM EDIT
    // =========================
    public function edit($id)
    {
        $produto = Produto::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();

        return view('produtos.edit', compact('produto'));
    }

    // =========================
    // ATUALIZAR PRODUTO
    // =========================
    public function update(Request $request, $id)
    {
        $produto = Produto::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();

        // Converte preço BR -> float
        if ($request->filled('preco')) {
            $request->merge(['preco' => $this->converterPrecoBrParaFloat($request->preco)]);
        }

        // Validação
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0.01',
            'quantidade' => 'required|integer|min:0',
            'descricao' => 'nullable|string',
        ]);

        $data = $request->only('nome', 'preco', 'quantidade', 'descricao');

        // Upload de imagem
        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }

        $produto->update($data);

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto atualizado com sucesso!');
    }

    // =========================
    // DELETAR PRODUTO
    // =========================
    public function destroy($id)
    {
        $produto = Produto::where('id', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();

        $produto->delete();

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto excluído com sucesso!');
    }
}
