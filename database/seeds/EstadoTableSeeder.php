<?php

use Illuminate\Database\Seeder;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->truncate();

        DB::table('estados')->insert([
            'sigla' =>'AC',
            'nome' => 'Acre'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'AL',
            'nome' => 'Alagoas'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'AP',
            'nome' => 'Amapá'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'AM',
            'nome' => 'Amazonas'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'BA',
            'nome' => 'Bahia'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'CE',
            'nome' => 'Ceará'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'DF',
            'nome' => 'Distrito Federal'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'ES',
            'nome' => 'Espírito Santo'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'GO',
            'nome' => 'Goiás'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'MA',
            'nome' => 'Maranhão'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'MT',
            'nome' => 'Mato Grosso'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'MS',
            'nome' => 'Mato Grosso do Sul'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'MG',
            'nome' => 'Minas Gerais'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'PA',
            'nome' => 'Pará'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'PB',
            'nome' => 'Paraíba'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'PR',
            'nome' => 'Paraná'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'PE',
            'nome' => 'Pernambuco'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'PI',
            'nome' => 'Piauí'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'RJ',
            'nome' => 'Rio de Janeiro'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'RN',
            'nome' => 'Rio Grande do Norte'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'RS',
            'nome' => 'Rio Grande do Sul'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'RO',
            'nome' => 'Rondônia'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'RR',
            'nome' => 'Roraima'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'SC',
            'nome' => 'Santa Catarina'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'SP',
            'nome' => 'São Paulo'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'SE',
            'nome' => 'Sergipe'
        ]);
        DB::table('estados')->insert([
            'sigla' =>'TO',
            'nome' => 'Tocantins'
        ]);

    }
}
