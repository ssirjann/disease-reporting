<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {

    $no_of_patients = $faker->numberBetween(1, 10);
    $user_id        = $faker->randomElements(User::all()->pluck());
    $priority       = \App\User::find($user_id)->isAuthorized() ? 5 : 1;
    $priority       *= $no_of_patients;

    return [
        'user_id'       => $user_id,
        'disease_id'    => $faker->randomElement([68, 75, 90, 101, 150, 183]),
        'location'      => json_encode(["latitude" => "27.684069", "longitude" => "85.3334031"]),
        'district'      => $faker->randomElement(['Kathmandu', 'Bhaktapur']),
        'no_of_victims' => $no_of_patients,
        'priority'      => $priority,
        'type'          => $faker->randomElement(['authorized', 'normal']),
    ];
});
