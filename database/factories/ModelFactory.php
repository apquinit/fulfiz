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

// Factory method for User model
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->unique()->userName,
        'password' => app('hash')->make($faker->password),
    ];
});
