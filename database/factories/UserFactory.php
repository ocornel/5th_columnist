<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use App\User;
use App\Utils;
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
    # Prepare Roles
    $count_roles = Role::count();
    if ($count_roles == 0) {
        $role_seeder = new RoleSeeder();
        $role_seeder->run();
    }
    $role_ids = [];
    foreach (Role::all() as $role) {
        array_push($role_ids, $role->id);
    }

    $urls = [null,$faker->url()];

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'about'=>Utils::getWords(rand(10,300)),
        'url'=>$urls[array_rand($urls)],
        'role_id'=>$role_ids[array_rand($role_ids)]
    ];
});
