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

    public function getUserAttribute() {
        return User::find($this->created_by);
    }

    public function getChildrenAttribute() {
        return Comment::where('parent_id', $this->id)->get();
    }

    public function getParentAttribute() {
        return Comment::find($this->parent_id);
    }

    public static function defaultCommentStatus() {
        try {
            if ($option = Option::where('name', 'comment_default_status')->first()) {
                return $option->value;
            }
        }
        catch (\Exception $exception) {
            return self::STATUS_DRAFT;
        }
        return self::STATUS_DRAFT;
    }
}
