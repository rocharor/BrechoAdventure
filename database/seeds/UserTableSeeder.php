<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Ricardo Rocha',
            'email' => 'rocharor@gmail.com',
            'dt_nascimento' => '1986-11-19',
            'telefone_fixo' => '11 11111111',
            'nome_imagem' => 'padrao.jpg',
            'password' => '$2y$10$ikMLqVZKZq1U.eh4YzqeDOES/CALkqW2eBpKWFFbrJ7e9SJxKI/rG'
        ]);

        factory(User::class)->create([
            'name' => 'Deborah Rocha',
            'email' => 'rick_nrs@hotmail.com',
            'dt_nascimento' => '1985-11-11',
            'telefone_fixo' => '22 22222222',
            'nome_imagem' => 'padrao.jpg',
            'password' => '$2y$10$ikMLqVZKZq1U.eh4YzqeDOES/CALkqW2eBpKWFFbrJ7e9SJxKI/rG'
        ]);
    }
}
