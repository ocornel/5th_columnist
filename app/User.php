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
        try {
            if (User::where('username', $uname)->count() > 0) {
                self::generateUserName();
            }
        }
        catch (\Exception $exception) {
            return $uname;
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

    public function getFullNameAttribute() {
        if ($this->display_name) {
            return $this->display_name;
        }
        if ($this->name) {
            return $this->name;
        }
        return $this->username;
    }
}
