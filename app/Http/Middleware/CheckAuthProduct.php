<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Produto;
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
        // $produto_id = base64_decode($request->route('id'));
        $produto_id = $this->decryptCustom($request->route('id'));
        $retorno = Produto::where('id', $produto_id)->where('user_id', Auth::user()->id)->get();

        if (count($retorno) == 0) {
            abort(403);
        }

        return $next($request);
    }
}
