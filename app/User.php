<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'url', 'display_name', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function generateUserName() {
        $uname = Utils::random_string(7,'l');
        if (User::where('username', $uname)->count() > 0) {
            self::generateUserName();
        }
        return $uname;
    }

    public function getRoleAttribute() {
        return Role::find($this->role_id);
    }

    public function getRoleNameAttribute() {
        if($role = $this->role) {
            return $role->name;
        }
        return "Unassigned.";
    }

    public function getMetasAttribute() {
        return UserMeta::where('user_id', $this->id)->get();
    }
}
