<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// $factory->define(App\Models\User::class, function (Faker\Generator $faker) {
//     static $password;
//
//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'password' => $password ?: $password = bcrypt('secret'),
//         'remember_token' => str_random(10),
//     ];
// });

$factory->define(App\Models\Categoria::class, function (Faker\Generator $faker) {
    return [];
});

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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [];
});

$factory->define(App\Models\Acl\Role::class, function (Faker\Generator $faker) {
    return [];
});

$factory->define(App\Models\Acl\Permission::class, function (Faker\Generator $faker) {
    return [];
});
