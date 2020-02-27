<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionRole extends Model
{
    protected $fillable = ['action_id', 'role_id'];

    public function getRoleAttribute() {
        return Role::find($this->role_id);
    }

    public function getActionAttribute() {
        return Action::find($this->action_id);
    }
}
