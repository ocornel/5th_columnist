<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            if ($this->command) $this->command->info('Creating Default Users');



        $admin_role = Role::where('name', 'Administrator')->first();
        if ($admin_role) $admin_role_id = $admin_role->id; else $admin_role_id = null;
        User::create([
            'name' => 'Martin Cornel',
            'email' => "mrtncornel@gmail.com",
            'password' => bcrypt('password'),
            'username' => 'mcornel',
            'role_id' => $admin_role_id
        ]);
    }
}
