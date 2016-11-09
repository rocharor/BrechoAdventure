<?php

use Illuminate\Database\Seeder;
use App\Models\Frase;

class FraseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Frase::truncate();

        factory(Frase::class)->create([
            'frase' => 'Frase Modelo'
        ]);

        factory(Frase::class, 15)->create();
    }
}
