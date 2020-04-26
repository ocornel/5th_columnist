<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeMessage extends Model
{

    protected $fillable = ['message', 'action_url', 'status'];

    const STATUS_NEW = 'New';
    const STATUS_READ = 'Read';
    const STATUS_DELETED = 'Deleted';

    const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_READ,
        self::STATUS_DELETED
    ];
}
