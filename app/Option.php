<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['key', 'value', 'default', 'value_type'];

    const TYPE_NUM = 'Numerical';
    const TYPE_STR = 'Short text';
    const TYPE_LON = 'Long text';

    const VALUE_TYPES = [
        self::TYPE_NUM,
        self::TYPE_STR,
        self::TYPE_LON
    ];

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
