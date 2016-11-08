<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frases extends Model
{
    protected $table = 'frases';

    public function getFrases()
    {
        $frases = Frases::all();
        $frase = [];
        if (count($frases) > 0){
            $frase = $frases[rand(0,(count($frases)-1))];
        }
        //$frases = Frases::find(1);

        return $frase;
    }
}
