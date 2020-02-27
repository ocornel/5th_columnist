<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description', 'status'];

    const STATUS_ACTIVE = "Active";
    const STATUS_DEACTIVATED = "Deactivated";

    public function getUsersAttribute() {
        return User::where('role_id', $this->id)->get();
    }

    public function getActionsAttribute() {
        $role_actions = ActionRole::where('role_id', $this->id)->get();
        $actions = [];
        foreach ($role_actions as $role_action) {
            array_push($actions, $role_action->action);
        }
        return $actions;
    }
}
