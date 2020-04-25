<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'content', 'created_by', 'likes', 'dislikes', 'rating', 'status', 'parent_id'];

    const STATUS_DRAFT = "Draft";
    const STATUS_APPROVED = "Approved";
    const STATUS_DELETED = "Deleted";

    public function getPostAttribute() {
        return Post::find($this->post_id);
    }
    public function getAuthorAttribute() {
        return User::find($this->created_by);
    }

    public function getChildrenAttribute() {
        return Comment::where('parent_id', $this->id)->get();
    }

    public function getParentAttribute() {
        return Comment::find($this->parent_id);
    }

    public function resolveRating() {
        $max = intval(Option::ValueByKey('Maximum Rating', 100));
        $this->update([
            'rating' => round($max * ($this->likes /($this->likes + $this->dislikes)),2)
        ]);
    }

    public function resolveStuff() {
        $this->resolveRating();
    }

    public static function defaultCommentStatus() {
        return Option::ValueByKey('Default Comment Status', self::STATUS_APPROVED);
    }
}
