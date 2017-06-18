<?php

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::truncate();

        factory(Categoria::class)->create([
            'categoria' => 'Aquático'
        ]);
        factory(Categoria::class)->create([
            'categoria' => 'Camping'
        ]);
        factory(Categoria::class)->create([
            'categoria' => 'Ciclismo'
        ]);
        factory(Categoria::class)->create([
            'categoria' => 'Fitnes'
        ]);
        factory(Categoria::class)->create([
            'categoria' => 'Trilha & Trekking'
        ]);
        factory(Categoria::class)->create([
            'categoria' => 'Escalada'
        ]);

        //factory(Categoria::class, 15)->create();
    }
}
