<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'url', 'display_name', 'role_id', 'about', 'ppic_url'
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
        return "Unassigned Role";
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

    public function canAction($action_text = null) {
        return $this->actionCan($action_text);
    }

    public function actionCan($action_text = null) {
//        todo privilege check
        return true;
    }

    public function getWebLinkAttribute() {
        if ($this->url) {
            return $this->url;
        }
        return route('load_author', [$this, $this->full_name]);
    }

    public function getPpicAttribute() {
        if ($this->ppic_url) {
            return URL::to('storage/' . $this->ppic_url);
        }
        return URL::to('img/fallback_images/no-ppic.png');
    }

    public function getPostsAttribute() {
        return Post::where('created_by', $this->id)->get();
    }

    public function getHasPublishedPostAttribute() {
        foreach ($this->posts as $post) {
            if ($post->status == Post::STATUS_PUBLISHED) return true;
        }
        return false;
    }

    public function getMessagesAttribute() {
        return NoticeMessage::where('status', '!=', NoticeMessage::STATUS_DELETED)->get()->filter( function ($message) {
            return $message->role_id == $this->role_id;
        })->groupBy('status');
    }

    public function getUnreadMessagesAttribute() {
        return NoticeMessage::whereStatus(NoticeMessage::STATUS_NEW)->get()->filter( function ($message) {
            return $message->role_id == $this->role_id;
        });
    }

    public function getMessageCountAttribute() {
        return $this->unread_messages->count();
    }

    public static function publishedAuthors() {
        return User::all()->filter( function ($user) {
            return $user->has_published_post;
        });
    }
}
