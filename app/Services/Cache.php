<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache as CacheNative;
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
        return  CacheNative::get($key);
    }

    public function setCache($key,$value)
    {
        // return CacheNative::put($key, $value, 1);
        return CacheNative::forever($key, $value);
    }

    public function deleteCache($key)
    {
        return CacheNative::pull($key);
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
