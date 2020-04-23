<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RoleSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(OptionsSeeder::class);
         $this->call(ActionsSeeder::class);
         $this->call(MenusSeeder::class);
         $this->call(CategoriesSeeder::class);

    }
}
