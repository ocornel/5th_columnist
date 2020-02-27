<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    protected $fillable = ['meta_name', 'meta_value', 'post_id'];

    public function getPostAttribute() {
        return Post::find($this->user_id);
    }
}
