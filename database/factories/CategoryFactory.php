<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Utils;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'=>Utils::getWords(1)
    ];
});
