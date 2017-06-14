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
        $produto = Produto::where('slug', $request->route('param'))->select('status')->first();
        if ($produto->status != 1) {
            return redirect()->route('home')->with('erro','Produto não disponível.');
        }

        return $next($request);
    }
}
