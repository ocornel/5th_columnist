<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $fillable = ['meta_name', 'meta_value', 'user_id'];

    public function getUserAttribute() {
        return User::find($this->user_id);
    }
}
