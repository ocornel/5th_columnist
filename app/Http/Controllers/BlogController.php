<?php

namespace App\Http\Controllers;

use App\Category;
use App\MenuItem;
use App\Option;
use App\Page;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    function landing() {
        $popular_category = Category::MostPopular();
        $popular_post = Post::MostPopular();
//        todo limit trending posts to iption 'Trending Post Count'
        $context = [
            'most_popular_category' => $popular_category,
            'most_popular_post' => $popular_post,
            'categories' => Category::whereNotIn('name',  [Category::UNCATEGORIEZED, $popular_category->name])->orderby('view_count', 'DESC')->get(),
            'latest_posts' =>Post::orderby('id', 'DESC')->take(intval(Option::ValueByKey('Latest Post Count', 5)))->get(),
            'trending_posts' =>Post::orderby('view_count', 'DESC')->take(intval(Option::ValueByKey('Trending Post Count', 5)))->get(),

        ];
        return view('public.landing', $context);
    }

    public function load_menu_item(MenuItem $menuItem) {
        $page = Page::find($menuItem->page_id);
        return redirect(route('load_page', [$page->id, $page->name]));
    }

    public function load_page(Page $page) {
        dd('Page Object', $page);
    }

    public function load_post(Post $post) {
        dd('Post Object', $post);
    }
}
