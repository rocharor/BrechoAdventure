<?php

use Illuminate\Database\Seeder;
use App\Models\Site\Produto;

class ProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produto::truncate();

        factory(Produto::class, 11)->create();        
    }
}
