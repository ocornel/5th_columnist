<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'post_count'];

    public function getPostsAttribute() {
        return Post::where('status', '!=', Post::STATUS_DELETED)->get()->filter(function ($post) {
            return in_array($this->name, explode(',', $post->tags));
        });
    }

    public function getHasPublishedPostAttribute() {
        foreach ($this->posts as $post) {
            if ($post->status == Post::STATUS_PUBLISHED) return true;
        }
        return false;
    }

    public function resolvePostCount() {
        $this->update([
            'post_count'=>count($this->posts)
        ]);
        return true;
    }

    public function resolveStuff() {
        $this->resolvePostCount();
    }

    public static function publishedTags()
    {
        return Tag::all()->filter(function ($tag) {
            return $tag->has_published_post;
        });
    }
}
