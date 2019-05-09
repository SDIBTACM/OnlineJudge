<?php

use App\Models\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->name,
        'nickname' => $faker->name,
        'password' => bcrypt('password'), // password
        'school' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->randomElement(['student', 'teacher', 'admin']),
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'admin', [
    'role' => 'admin'
]);

$factory->state(User::class, 'teacher', [
    'role' => 'teacher'
]);

$factory->state(User::class, 'student', [
    'role' => 'student'
]);