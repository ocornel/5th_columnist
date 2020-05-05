<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['menu_id', 'label', 'page_id', 'parent_item', 'menu_order'];

    public function getMenuAttribute(){
        return Menu::find($this->menu_id);
    }

    public function getPageAttribute() {
        return Page::find($this->page_id);
    }
}
