<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Product;
use App\Services\Util;

class CheckAuthProduct
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
        $retorno = [];
        if (is_string($request->route('param'))) {
            $retorno = Product::where('slug', $request->route('param'))->where('user_id', Auth::user()->id)->get();
        }else{
            $retorno = Product::where('id', $request->route('param'))->where('user_id', Auth::user()->id)->get();
        }

        if (count($retorno) == 0) {
            abort(403);
        }

        return $next($request);
    }
}
