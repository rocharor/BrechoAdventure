<?php

namespace App\Models\MinhaConta;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Perfil extends Model
{
    public function salvarPerfil($dados)
    {
        Auth::user()->name = 'teste';
        Auth::save();
        dd(Auth::user()->name);
    }

}
