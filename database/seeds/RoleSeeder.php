<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Default Roles');
        $roles = ['Administrator','Editor', 'Subscriber'];
        foreach ($roles as $role) {
            Role::create(
                ['name'=>$role]);
        }
    }
}
