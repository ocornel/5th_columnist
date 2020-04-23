<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Menu;
use App\MenuItem;
use App\Page;
use App\Utils;
use Faker\Generator as Faker;

$factory->define(MenuItem::class, function (Faker $faker) {
    # Prepare Menus
    $count_menus = Menu::count();
    if ($count_menus < 2) {
        factory(Menu::class, 3)->create();
    }
    $menu_ids = [];
    foreach (Menu::all() as $menu) {
        array_push($menu_ids, $menu->id);
    }

    # Prepare Pages
    $count_pages = Page::count();
    if ($count_pages == 0) {
        factory(Page::class, 10)->create();
    }
    $page_ids = [];
    foreach (Page::all() as $page) {
        array_push($page_ids, $page->id);
    }

    # Prepare parent items
    $bias_comment_ids = [null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null];
    if (MenuItem::count() > 0) {
        foreach (MenuItem::all() as $comment) {
            array_push($bias_comment_ids, $comment->id);
        }
    }


    return [
        'menu_id' => $menu_ids[array_rand($menu_ids)],
        'label' => Utils::getWords(rand(1, 3)),
        'page_id' => $page_ids[array_rand($page_ids)],
        'parent_item' => $bias_comment_ids[array_rand($bias_comment_ids)],
        'menu_order' => rand(0, 4)
    ];
});
