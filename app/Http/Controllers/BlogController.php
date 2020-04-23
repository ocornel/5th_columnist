<?php

namespace App\Http\Controllers;

use App\Action;
use App\Category;
use App\Menu;
use App\MenuItem;
use App\Option;
use App\Page;
use App\Post;
use App\Role;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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

    public function DeleteAll() {
        foreach (Role::all() as $item) $item->delete();
        foreach (Category::all() as $item) $item->delete();
        foreach (Option::all() as $item) $item->delete();
        foreach (Action::all() as $item) $item->delete();
        foreach (Page::all() as $item) $item->delete();
        foreach (Tag::all() as $item) $item->delete();
        foreach (Menu::all() as $item) $item->delete();
    }

    public function prepare_dummy() {
        $this->DeleteAll();
        Artisan::call('db:seed');
        Artisan::call('db:seed --class=DummyData');
        return redirect(route('landing'));
    }

    public function delete_dummy() {
        $this->DeleteAll();
        Artisan::call('db:seed');
        return redirect(route('landing'));
    }
}
