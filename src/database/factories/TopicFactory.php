<?php

$factory->define(App\Topic::class, function (Faker\Generator $faker) {
    return [
        "subject" => $faker->name,
        "description" => $faker->name,
        "email" => $faker->safeEmail,
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "status" => $faker->randomNumber(2),
    ];
});
