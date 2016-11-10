<?php

namespace App\Models\Site;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Frase as FraseModel;

class Home extends Model
{
    public function frasesHome()
    {
        $objFrase = new FraseModel();
        $frase = $objFrase->getFrases();
        return $frase;
    }
}
