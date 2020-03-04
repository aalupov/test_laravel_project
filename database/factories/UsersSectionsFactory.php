<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\UsersSectionsRelationships as Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $sectionId = rand(1, 15);
    $userId = rand(1, 16);
    
    return [
        'user_id' => $userId,
        'section_id' => $sectionId
    ];
});
