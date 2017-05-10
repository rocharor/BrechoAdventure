<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Produto;

class CheckAuthProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $retorno = Produto::where('id', $request->route('id'))->where('user_id', Auth::user()->id)->get();

        if (count($retorno) == 0) {
            abort(403);
        }

        return $next($request);
    }
}
