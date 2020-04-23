<?php

use App\Menu;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Default Menus');

        $menus = ['Main'];
        foreach ($menus as $menu) {
            Menu::create(
                ['name'=>$menu]);
        }
    }
}
