<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $fillable = ['name', 'description', 'status', 'post_count', 'view_count'];

    const STATUS_ACTIVE = "Active";
    const STATUS_DEACTIVATED = "Deactivated";

    const UNCATEGORIEZED = "No Category";

    public function getPostsAttribute()
    {
        return Post::where('category_id', $this->id)->orderby('id', 'DESC')->get();
    }

    public function LatestPosts($take = null)
    {
        $count = $take == null ? Option::ValueByKey('Limit Latest Post Per Category', 5) : $take;
        return Post::where('status', Post::STATUS_PUBLISHED)->where('category_id', $this->id)->orderby('id', 'DESC')->take($count)->get();
    }

    public function getLastPostAttribute()
    {
        return Post::where('category_id', $this->id)->orderby('id', 'DESC')->first();
    }

    public function getLastPostTitleAttribute()
    {
        if ($post = $this->last_post) {
            return $post->title;
        }
        return 'None';
    }

    public function resolvePostCount()
    {
        $this->update([
            'post_count' => count($this->posts)
        ]);
        return true;
    }

    public function resolveViewCount()
    {
        $view_count = 0;
        foreach ($this->posts as $post) {
            $post->resolveName();
            $view_count += $post->view_count;
        }
        $this->update([
            'view_count' => $view_count
        ]);
        return true;
    }

    public function resolveStuff() {
        $this->resolveViewCount();
        $this->resolvePostCount();
    }

    public static function MostPopular()
    {
        return Category::where('name', '!=', Category::UNCATEGORIEZED)->orderby('view_count', 'DESC')->first();
    }


    public function getHasPublishedPostAttribute() {
        foreach ($this->posts as $post) {
            if ($post->status == Post::STATUS_PUBLISHED) return true;
        }
        return false;
    }

    public static function publishedCategories() {
        return Category::all()->filter(function ($category) {
            return $category->has_published_post;
        });
    }
}
