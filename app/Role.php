<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description', 'status'];

    const STATUS_ACTIVE = "Active";
    const STATUS_DEACTIVATED = "Deactivated";
}
