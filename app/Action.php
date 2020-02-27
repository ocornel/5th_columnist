<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = ['name', 'description'];


    public function getRolesAttribute() {
        $role_actions = ActionRole::where('action_id', $this->id)->get();
        $roles = [];
        foreach ($role_actions as $role_action) {
            array_push($roles, $role_action->role);
        }
        return $roles;
    }
}
