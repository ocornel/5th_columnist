<?php

use App\Action;
use Illuminate\Database\Seeder;

class ActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command) $this->command->info('Creating User Actions');

        $actions = array(
            [
                'name' => 'View Reports',
                'description' => "Views, downloads and exports reports and charts.",
            ],
            [
                'name' => 'Create Post',
                'description' => "Creates, edits and delete posts.",
            ],
            [
                'name' => 'Publish Post',
                'description' => "Changes the status of a post between published and draft.",
            ],
            [
                'name' => 'Publish Comment',
                'description' => "Changes the status of a comment between approved and draft.",
            ],
            [
                'name' => 'Manage Users',
                'description' => "Changes the status of a comment between approved and draft.",
            ],
            [
                'name' => 'Create Page',
                'description' => "Creates, edits and deletes pages.",
            ]
        );

        foreach ($actions as $action) {
            Action::create([
                'name' => $action['name'],
                'description' => $action['description']
            ]);
        }
    }
}
