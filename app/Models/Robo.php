<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Models\Site\Produto;


class Robo extends Model
{
    public $modelProduto;

    public function __construct()
    {
        $this->modelProduto = new Produto();
    }

    public function mountProductsCache()
    {
        $products = Produto::where('status', 1)
        ->select('titulo', 'descricao', 'slug')
        ->get();

        $data = [];
        foreach ($products as $product) {
            $data[$product['slug']] = $product['titulo'] . $product['descricao'];
        }

        Cache::pull('products');
        Cache::forever('products',$data);
    }

    public function mountFilterCache()
    {
        $products = $this->modelProduto->getProdutos();
        foreach ($products['itens'] as $key=>$product) {
            if (!isset($data['Categoria']['itens'][$product->categoria->categoria])) {
                $data['Categoria']['itens'][$product->categoria->categoria] = [
                    'id'=>$product->categoria_id,
                    'rotulo'=>$product->categoria->categoria,
                    'qtd' => 1
                ];
            }else{
                $data['Categoria']['itens'][$product->categoria->categoria]['qtd'] += 1;
            }

            if (!isset($data['Estado']['itens'][$product->estado])) {
                $data['Estado']['itens'][$product->estado] = [
                    'id'=>$product->estado,
                    'rotulo'=>$product->estado,
                    'qtd' => 1
                ];
            }else{
                $data['Estado']['itens'][$product->estado]['qtd'] += 1;
            }
        }

        Cache::pull('filter');
        Cache::forever('filter',$data);
    }
}
