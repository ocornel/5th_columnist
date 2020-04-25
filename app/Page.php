<?php

namespace App;

use App\Utils;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title', 'created_by', 'content', 'name', 'view_count', 'description'
    ];

    public static function RandomPageName() {
        $name = Utils::random_string(7,'l');
        try {
            if (Page::where('name', $name)->first()) {
                Utils::notifyDev('Page names shuffles running out.');
                return self::RandomPageName();
            }
        }
        catch (\Exception $exception) {
            Utils::notifyDev($exception->getMessage());
        }

        return $name;
    }

    public function getAuthorAttribute() {
        return User::find($this->created_by);
    }

    public function resolveName()
    {
        $name = $this->title ? str_replace(' ', '_', $this->title) : self::generateName();
        $this->update([
            'name' => $name
        ]);
        return true;
    }

    public function resolveStuff() {
        $this->resolveName();
    }
}
