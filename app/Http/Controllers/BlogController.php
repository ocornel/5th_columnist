<?php

namespace App\Http\Controllers;

use App\Action;
use App\Category;
use App\Comment;
use App\Menu;
use App\MenuItem;
use App\Option;
use App\Page;
use App\Post;
use App\Role;
use App\Tag;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{

    function landing() {
        $context = [
            'most_popular_category' => Category::MostPopular(),
            'most_popular_post' => Post::MostPopular(),
            'categories' => Category::whereNotIn('name',  [Category::UNCATEGORIEZED, Category::MostPopular()->name])->orderby('view_count', 'DESC')->get(),
            'latest_posts' =>Post::where('status', Post::STATUS_PUBLISHED)->orderby('id', 'DESC')->take(intval(Option::ValueByKey('Latest Post Count', 5)))->get(),
            'trending_posts' => Post::TrendingPosts(),
        ];
        return view('public.landing', $context);
    }

    public function load_menu_item(MenuItem $menuItem) {
        $page = Page::find($menuItem->page_id);
        return redirect(route('load_page', [$page->id, $page->name]));
    }

    public function load_page(Page $page) {
        $page->update([
            'view_count'=>$page->view_count + 1
        ]);
        $context =[
            'page' => $page
        ];
        return view('public.load_page', $context);
    }

    public function load_post(Post $post) {
        if ($user = Auth::user() == null || !Auth::user()->canAction('Publish Post')) {
            if ($post->status != Post::STATUS_PUBLISHED) {
//            todo create page for when post not published
                dd('Post not Published: page coming here.');
            }
        }
        if ($post->status == Post::STATUS_DELETED) {
//            todo create page for when post is deleted
            dd('Post Deleted page coming here.');
        }

        $post->update([
            'view_count'=>$post->view_count + 1
        ]);
        $post->resolveStuff();
        $context =[
            'post' => $post,
            'tags' =>$post->tag_list,
            'related_posts' =>$post->related_posts
        ];
        return view('public.load_post', $context);
    }

    public function post_toggle(Post $post) {
        if ($user = Auth::user()) {
            if ($user->canAction('Publish Post')) {
                $new_status = $post->status == Post::STATUS_DRAFT? Post::STATUS_PUBLISHED : Post::STATUS_DRAFT;
                $post->update([
                    'status'=> $new_status
                ]);
                return redirect()->back()->with('success', 'Post updated successfully.');
            }
        }
        return redirect()->back()->with('error', 'You cannot perform that action.');
    }


    public function load_author(User $user) {
        $context =[
            'author' => $user,
            'trending_posts' => Post::TrendingPosts(),
            'other_authors' => User::publishedAuthors()
        ];
        return view('public.load_author', $context);
    }

    public function post_comment(Request $request) {
        $request['created_by'] = Auth::user()->id;
        if(strlen($request['content']) > 1000) {
            Session::flash('error', 'Comment too long.');
            return redirect()->back();
        }
        $comment = Comment::create($request->all());
        return redirect(route('load_post',[$comment->post, $comment->post->name]));
    }

    public function load_category(Category $category,$name = null, $post_id = null) {
        foreach ($category->posts as $post) {
            $post->resolveStuff();
        }
        $category->resolveStuff();
        $lead_post = Post::find(intval($post_id));
        $context =[
            'post' => $lead_post,
            'category' =>$category,
            'trending_posts' => Post::TrendingPosts(),
            'other_categories' => Category::publishedCategories()
        ];
        return view('public.load_category', $context);
    }

    public function load_tag(Tag $tag) {
        foreach ($tag->posts as $post) {
            $post->resolveStuff();
        }
        $tag->resolveStuff();

        $context =[
            'tag' =>$tag,
            'trending_posts' => Post::TrendingPosts(),
            'other_tags' => Tag::publishedTags()
        ];
//        dd('tag content coming here.', $context);
        return view('public.load_tag', $context);
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
