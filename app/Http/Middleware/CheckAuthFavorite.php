<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Site\Favorito;

class CheckAuthFavorite
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
        $favorito = Favorito::find($request->id);

        if (Auth::user()->id != $favorito->user_id) {
            return redirect()->route('minha-conta.meus-favorito',1)->with('erro','Erro ao excluir favorito.');
        }

        return $next($request);
    }
}
