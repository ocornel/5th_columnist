<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Role;
use App\User;
use App\Post;
use App\Utils;
use Faker\Generator as Faker;


$factory->define(Post::class, function (Faker $faker) {
    # Prepare users
    $count_users = User::count();
    if ($count_users < 3) {
        factory(User::class, 100)->create();
    }
    $user_ids = [];
    foreach (User::whereIn('role_id', Role::AuthorRoles())->get() as $user) {
        array_push($user_ids, $user->id);
    }

    # Prepare categories
    $categories_count = Category::count();
    if ($categories_count ==0 ) {
        $categories_seeder = new CategoriesSeeder();
        $categories_seeder->run();
    }
    $category_ids = [];
    foreach (Category::all() as $category) {
        array_push($category_ids, $category->id);
    }

    $post_statuses = [Post::STATUS_DRAFT, Post::STATUS_PUBLISHED, Post::STATUS_DELETED];
    $comment_statuses = [Post::COMMENTS_ENABLED, Post::COMMENTS_DISABLED];


    return [
        'created_by' =>$user_ids[array_rand($user_ids)],
        'publish_date'=> $faker->dateTimeBetween('-3 months'),
        'status' =>$post_statuses[array_rand($post_statuses)],
        'content' =>Utils::getWords(rand(50, 500)),
        'title' =>Utils::getWords(rand(3,5)),
        'description' =>Utils::getWords(rand(5,20)),
        'comment_status' =>$comment_statuses[array_rand($comment_statuses)],
        'view_count' => rand(0,1000),
        'likes' =>rand(0,50),
        'dislikes' =>rand(0,50),
        'category_id' => $category_ids[array_rand($category_ids)]
    ];
});
