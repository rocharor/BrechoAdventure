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
    return [
        'categoria' => $faker->word
    ];
});

$factory->define(App\Models\Frase::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_br\Person($faker));
    
    return [
        'frase' => $faker->text(rand(100, 150)),
        'autor' => $faker->firstName
    ];
});
