<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\UserMeta;
use App\Utils;
use Faker\Generator as Faker;

$factory->define(UserMeta::class, function (Faker $faker) {
    # Prepare users
    $count_users = User::count();
    if ($count_users < 3) {
        factory(User::class, 100)->create();
    }
    $user_ids = [];
    foreach (User::all() as $user) {
        array_push($user_ids, $user->id);
    }

    return [
        'meta_name' => Utils::getWords(rand(1,2)),
        'meta_value' => Utils::getWords(rand(1,5)),
        'user_id' => $user_ids[array_rand($user_ids)],
    ];
});
