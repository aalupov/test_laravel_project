<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Sections as Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $name = $faker->sentence(rand(1, 3), true);
    $txt = $faker->realText(rand(40, 60));
    $logo = 'logo_' . rand(1, 15) . '.jpg';

    return [
        'name' => $name,
        'description' => $txt,
        'logo' => $logo,
        'created_at' => now(),
        'updated_at' => now()
    ];
});
