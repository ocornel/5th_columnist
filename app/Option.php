<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['key', 'value', 'default'];

    public function getSetValueAttribute() {
        if ($this->value) {
            return $this->value;
        }
        return $this->default;
    }

    public static function ValueByKey($key = null, $fallback = null) {
        if ($option = Option::where('key', $key)->first()) {
            return $option->set_value;
        }
        if ($fallback) return $fallback;
        return "No Option";
    }
}
