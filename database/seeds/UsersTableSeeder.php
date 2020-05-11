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
            'name' => 'System Admin',
            'email' => "sadmin@mcornel.com",
            'password' => bcrypt('Sy5@dm!n'),
            'username' => 'sysadmin',
            'role_id' => $admin_role_id
        ]);
    }
}
