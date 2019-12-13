<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class ProdutoController extends Controller
{   
    //TELA INICIAL
    public function index() {
        $produtos = Produto::all();
        $total = Produto::all()->count();
        return view('list-produtos', compact('produtos', 'total'));
    }
    //CRIA PRODUTO
    public function create() {
        return view('include-produto');
    }

    //REDIRECIONA LISTA E SALVA PRODUTO  
    public function store(Request $request) {
        $product = new Produto;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->imagem = $request->imagem;
        $product->save();
        return redirect()->route('product.index')->with('message', 'Produto criado com sucesso!');
    }

    public function show($id) {
        //
    }

    //CHAMA EDIÇÃO DE PRODUTOS
    public function edit($id) {
        $product = Produto::findOrFail($id);
        return view('alter-produto', compact('product'));
    }

    //EDITA PRODUTOS
    public function update(Request $request, $id) {
        $product = Produto::findOrFail($id); 
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->save();
        return redirect()->route('product.index')->with('message', 'Produto alterado com sucesso!');
    }
    //APAGA PRODUTO
    public function destroy($id) {
        $product = Produto::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('message', 'Produto excluído com sucesso!');
    }
 
}
