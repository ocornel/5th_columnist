<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name'];

    public static function MainMenu() {
        return \App\Menu::where('name', 'Main')->first();
    }

    public static function MainMenuId() {
        if ($menu = self::MainMenu()) {
            return $menu->id;
        }
        return 1;
    }

    public function getItemsAttribute() {
        return MenuItem::where('menu_id', $this->id)->get();
    }
}
