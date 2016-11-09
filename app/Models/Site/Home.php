<?php

namespace App\Models\Site;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Frase;

class Home extends Model
{
    public function frasesHome(Frase $objFrase)
    {
        $frase = $objFrase->getFrases();
        return $frase;
    }
}
