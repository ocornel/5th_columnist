<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'content', 'user_id', 'likes', 'dislikes', 'rating', 'status', 'parent_id'];

    const STATUS_DRAFT = "Draft";
    const STATUS_APPROVED = "Approved";
    const STATUS_DELETED = "Deleted";

    public function getPostAttribute() {
        return Post::find($this->post_id);
    }

    public function getUserAttribute() {
        return User::find($this->user_id);
    }

    public function getChildrenAttribute() {
        return Comment::where('parent_id', $this->id)->get();
    }

    public function getParentAttribute() {
        return Comment::find($this->parent_id);
    }

    public static function defaultCommentStatus() {
        if ($option = Option::where('name', 'comment_default_status')->first()) {
            return $option->value;
        }
        return self::STATUS_DRAFT;
    }
}
