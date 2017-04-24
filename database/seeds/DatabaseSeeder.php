<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //desativa as chaves estrangeiras
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(FraseTableSeeder::class);
        $this->call(CategoriaTableSeeder::class);
        $this->call(ProdutoTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);

        //ativa as chaves estrangeiras
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
