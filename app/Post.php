<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Post extends Model
{
    protected $fillable = ['created_by', 'publish_date', 'status', 'content', 'title', 'comment_status', 'description',
        'password', 'name', 'comment_count', 'view_count', 'likes', 'dislikes', 'rating', 'category_id', 'tags', 'feature_image'];

    const STATUS_DRAFT = "Draft";
    const STATUS_PUBLISHED = "Published";
    const STATUS_DELETED = "Deleted";

    const COMMENTS_ENABLED = "Comments Allowed";
    const COMMENTS_DISABLED = "Comments Disabled";

    public static function generateName()
    {
        $name = Utils::random_string(10);
        try {
            if (Post::where('name', $name)->count() > 0) {
                self::generateName();
            }
        } catch (\Exception $exception) {
            return $name;
        }

        return $name;
    }

    public function getFeatureImageUrlAttribute()
    {
        if ($this->feature_image) {
            return URL::to('storage/' . $this->feature_image);
        }
        return Utils::GetFallbackImage();
    }

    public function getCommentsAttribute()
    {
        return Comment::where('post_id', $this->id)->get();
    }

    public function getApprovedCommentsAttribute() {
        return $this->comments->filter( function ($coment) {
            return $coment->status == Comment::STATUS_APPROVED;
        });
    }

    public function resolveCommentCount()
    {
        $this->update([
            'comment_count' => count($this->comments)
        ]);
        return true;
    }

    public function resolveName()
    {
        $name = $this->title ? str_replace(' ', '_', $this->title) : self::generateName();
        $this->update([
            'name' => $name
        ]);
        return true;
    }

    public function resolvePublishDate()
    {
        if(!$this->publish_date) {
            $this->update([
                'publish_date' => $this->created_at
            ]);
        }
        return true;
    }

    public function resolveStuff()
    {
        $this->resolveName();
        $this->resolveCommentCount();
        $this->resolvePublishDate();
    }

    public function getCategoryAttribute()
    {
        return Category::find($this->category_id);
    }

    public function getCategoryNameAttribute()
    {
        if ($category = $this->category) {
            return $category->name;
        }
        return Category::UNCATEGORIEZED;
    }

    public function getTagListAttribute()
    {
        $tag_ids = explode(',', $this->tags);
        return Tag::whereIn('id', $tag_ids)->get();
    }

    public function getRelatedPostsAttribute()
    {
        # Related posts are of the same category and share tags.
        return Post::where('status', self::STATUS_PUBLISHED)->where('category_id', $this->category_id)->get()->filter(function ($post) {
            $post_tag_ids = explode(',', $post->tags);
            $this_tag_ids = explode(',', $this->tags);
            return (sizeof(array_intersect($post_tag_ids, $this_tag_ids)) > 0);
        });
    }

    public function getMetasAttribute()
    {
        return PostMeta::where('post_id', $this->id)->get();
    }

    public function getAuthorAttribute()
    {
        return User::find($this->created_by);
    }

    public static function defaultPostStatus()
    {
        try {
            if ($option = Option::where('name', 'post_default_status')->first()) {
                return $option->value;
            }
        } catch (\Exception $exception) {
            return self::STATUS_DRAFT;
        }

        return self::STATUS_DRAFT;
    }


    public static function MostPopular()
    {
        return Post::where('status', self::STATUS_PUBLISHED)->orderby('view_count', 'DESC')->first();
    }

}
