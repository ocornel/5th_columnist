<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Post;
use App\PostMeta;
use App\Utils;
use Faker\Generator as Faker;

$factory->define(PostMeta::class, function (Faker $faker) {
    # Prepare posts
    $post_count = Post::count();
    if ($post_count == 0) {
        factory(Post::class, 50)->create();

    }
    $post_ids = [];
    foreach (Post::all() as $post) {
        array_push($post_ids, $post->id);
    }
    return [
        'meta_name' => Utils::getWords(rand(1,2)),
        'meta_value' => Utils::getWords(rand(1,5)),
        'post_id' => $post_ids[array_rand($post_ids)],
    ];
});
