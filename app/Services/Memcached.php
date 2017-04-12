<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Site\ProdutoController as Produto;

class Memcached
{
    public $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function getCache($key)
    {
        return  Cache::get($key);
    }

    public function setCache($key,$value)
    {
        // return Cache::put($key, $value, 1);
        return Cache::forever($key, $value);
    }

    public function deleteCache($key)
    {
        return Cache::pull($key);
    }

    public function updateCacheAll()
    {
        //Atualiza os produtos no cache
        // $products = $this->produto->getProducts();
        // $products = response()->json($products)->content();
        // $this->setCache('products', $products);

        //Cria array com o filtro lateral
        $dataFilter = $this->produto->mountDataFilter();
        $dataFilter = response()->json($dataFilter)->content();
        $this->setCache('filter', $dataFilter);
    }
}
