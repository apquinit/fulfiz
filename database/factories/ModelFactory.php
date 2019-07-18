<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Device;
use App\Models\Key;
use App\Models\LocationIqUser;
use App\Models\TimeZoneDbUser;
use App\Models\DarkSkyUser;
use App\Models\DuckDuckGoUser;
use App\Models\WolframAlphaUser;
use App\Models\User;

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

$factory->define(Device::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigitNotNull,
        'name' => Str::random(10),
        'description' => $faker->text,
        'status' => $faker->randomElement(['ENABLED', 'DISABLED']),
        'code' => Str::random(10),
    ];
});

$factory->define(Key::class, function (Faker $faker) {
    return [
        'name' => Str::random(10),
        'description' => $faker->text,
        'status' => $faker->randomElement(['ENABLED', 'DISABLED']),
        'token' => Str::random(10),
    ];
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(LocationIqUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigitNotNull,
        'status' => $faker->randomElement(['ENABLED', 'DISABLED']),
        'token' => Str::random(10),
    ];
});

$factory->define(TimeZoneDbUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigitNotNull,
        'status' => $faker->randomElement(['ENABLED', 'DISABLED']),
        'token' => Str::random(10),
    ];
});

$factory->define(DarkSkyUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigitNotNull,
        'status' => $faker->randomElement(['ENABLED', 'DISABLED']),
        'token' => Str::random(10),
    ];
});

$factory->define(DuckDuckGoUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigitNotNull,
        'status' => $faker->randomElement(['ENABLED', 'DISABLED']),
        'token' => Str::random(10),
    ];
});

$factory->define(WolframAlphaUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigitNotNull,
        'status' => $faker->randomElement(['ENABLED', 'DISABLED']),
        'token' => Str::random(10),
    ];
});
