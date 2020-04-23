<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Page;
use App\Role;
use App\User;
use App\Utils;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    # Prepare users
    $count_users = User::count();
    if ($count_users < 3) {
        factory(User::class, 100)->create();
    }
    $user_ids = [];
    foreach (User::whereIn('role_id', Role::AuthorRoles())->get() as $user) {
        array_push($user_ids, $user->id);
    }

    return [
        'title' =>Utils::getWords(rand(3,5)),
        'description' => Utils::getWords(rand(5,10)),
        'created_by' =>$user_ids[array_rand($user_ids)],
        'content' =>Utils::getWords(rand(50, 300)),
        'view_count' => rand(0,1000)
    ];
});
