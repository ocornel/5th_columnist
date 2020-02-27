<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    const STATUS_DRAFT = "Draft";
    const STATUS_PUBLISHED = "Published";
    const STATUS_DELETED = "Deleted";

    const COMMENTS_ENABLED = "Comments Allowed";
    const COMMENTS_DISABLED = "Comments Disabled";

    public static function generateName() {
        $name = Utils::random_string(10);
        if (Post::where('name', $name)->count() > 0) {
            self::generateName();
        }
        return $name;
    }

    public function getCommentsAttribute() {
        return Comment::where('post_id', $this->id)->get();
    }

    public function resolveCommentCount() {
        $this->update([
            'comment_count'=> count($this->comments)
        ]);
        return true;
    }
}
