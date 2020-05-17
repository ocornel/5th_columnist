<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use App\Utils;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => Utils::getWords(rand(1,3)),
    ];
});
