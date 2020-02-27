<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'status', 'post_count', 'view_count'];

    const STATUS_ACTIVE = "Active";
    const STATUS_DEACTIVATED = "Deactivated";

    public function getPostsAttribute() {
        return Post::where('category_id', $this->id)->get();
    }

    public function resolvePostCount() {
        $this->update([
            'post_count'=> count($this->posts)
        ]);
        return true;
    }

    public function resolveViewCount() {
        $view_count = 0;
        $posts = $this->posts;
        foreach ($posts as $post) {
            $view_count += $post->view_count;
        }
        $this->update([
            'view_count'=> $view_count
        ]);
        return true;
    }
}
