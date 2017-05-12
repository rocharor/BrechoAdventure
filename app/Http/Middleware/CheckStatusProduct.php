<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Site\Produto;
use App\Services\Util;

class CheckStatusProduct
{
    use Util;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $produto = Produto::find(base64_decode($request->route('produto_id')));
        $produto_id = $this->decryptCustom($request->route('produto_id'));
        $produto = Produto::find($produto_id);
        if ($produto->status != 1) {
                return redirect()->route('home')->with('erro','Produro não disponível.');
        }

        return $next($request);
    }
}
