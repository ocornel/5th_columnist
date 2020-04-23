<?php

use App\Role;
use Illuminate\Database\Seeder;
use Symfony\Component\Debug\Exception as E;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command) $this->command->info('Creating Default Roles');
        $roles = ['Administrator','Editor', 'Subscriber'];
        foreach ($roles as $role) {
            Role::create(
                ['name'=>$role]);
        }
    }
}
