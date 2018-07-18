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
        DB::table('categorias')->truncate();

        DB::table('categorias')->insert([
            'categoria' => 'Aquático',
            'slug' => str_slug('Aquático')
        ]);

        DB::table('categorias')->insert([
            'categoria' => 'Camping',
            'slug' => str_slug('Camping')
        ]);

        DB::table('categorias')->insert([
            'categoria' => 'Ciclismo',
            'slug' => str_slug('Ciclismo')
        ]);

        DB::table('categorias')->insert([
            'categoria' => 'Fitnes',
            'slug' => str_slug('Fitnes')
        ]);

        DB::table('categorias')->insert([
            'categoria' => 'Trilha & Trekking',
            'slug' => str_slug('Trilha & Trekking')
        ]);

        DB::table('categorias')->insert([
            'categoria' => 'Escalada',
            'slug' => str_slug('Escalada')
        ]);

        // Categoria::truncate();
        //
        // factory(Categoria::class)->create([
        //     'categoria' => 'Aquático'
        // ]);
        // factory(Categoria::class)->create([
        //     'categoria' => 'Camping'
        // ]);
        // factory(Categoria::class)->create([
        //     'categoria' => 'Ciclismo'
        // ]);
        // factory(Categoria::class)->create([
        //     'categoria' => 'Fitnes'
        // ]);
        // factory(Categoria::class)->create([
        //     'categoria' => 'Trilha & Trekking'
        // ]);
        // factory(Categoria::class)->create([
        //     'categoria' => 'Escalada'
        // ]);
    }
}
