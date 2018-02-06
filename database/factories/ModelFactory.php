<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Frase::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    return [
        // 'frase' => $faker->text(rand(100, 150)),
        'autor' => $faker->firstName
    ];
});

$factory->define(App\Models\Site\Produto::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    $titulo = $faker->text(rand(20, 30));
    return [
        'user_id' => rand(1,2),
        'categoria_id' => rand(1,5),
        'titulo' => $titulo,
        'descricao' => $faker->text,
        'valor' => $faker->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 3000),
        'estado' => 'novo',
        'nm_imagem' => 'sem-imagem.gif',
        'slug' => str_slug($titulo . ' ' . time()),
        'status' => 1
    ];
});
