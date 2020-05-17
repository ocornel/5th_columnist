<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use App\User;
use App\Utils;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    # Prepare users
    $count_users = User::count();
    if ($count_users < 3) {
        factory(User::class, 100)->create();
    }
    $user_ids = [];
    foreach (User::all() as $user) {
        array_push($user_ids, $user->id);
    }

    # Prepare posts
    $post_count = Post::count();
    if ($post_count == 0) {
        factory(Post::class, 50)->create();

    }
    $post_ids = [];
    foreach (Post::all() as $post) {
        array_push($post_ids, $post->id);
    }

    # Prepare parent comments
    $bias_comment_ids = [null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null];
    if (Comment::count() > 0) {
        foreach (Comment::all() as $comment) {
            array_push($bias_comment_ids, $comment->id);
        }
    }

    $comment_statuses = [Comment::STATUS_DRAFT, Comment::STATUS_APPROVED, Comment::STATUS_DECLINED];
    return [
        'post_id' => $post_ids[array_rand($post_ids)],
        'content' => Utils::getWords(rand(3, 30)),
        'created_by' => $user_ids[array_rand($user_ids)],
        'likes' => rand(0, 50),
        'dislikes' => rand(0, 50),
        'status' => $comment_statuses[array_rand($comment_statuses)],
        'parent_id' => $bias_comment_ids[array_rand($bias_comment_ids)]
    ];
});
