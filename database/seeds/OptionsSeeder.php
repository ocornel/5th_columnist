<?php

use App\Option;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Options are settings

            if ($this->command) $this->command->info('Creating Option Settings');


        $options_array = array(
            [
                'key' => 'Landing Title',
                'default' => "What is trending in Kenya.",
            ],
            [
                'key' => 'Landing Description',
                'default' => "Getting all the news that are trending in Kenya.",
            ],

            [
                'key' => 'Contact Title',
                'default' => "Talk to us.",
            ],
            [
                'key' => 'Contact Description',
                'default' => "Find our contact information and contact form.",
            ],

            [
                'key' => 'Footer Title',
                'default' => "Welcome to Inatrend Kenya",
            ],

            [
                'key' => 'Footer Description',
                'default' => "
                <p>
                    <small>We are here to get you the latest that is trending in Kenya.</small>
                </p>
                <div class=\"social-list\">
                    <a class=\"social-list-item\" href=\"http://twitter.com\">
                        <span class=\"icon icon-twitter\"></span>
                    </a>
                    <a class=\"social-list-item\" href=\"http://facebook.com\">
                        <span class=\"icon icon-facebook\"></span>
                    </a>
                    <a class=\"social-list-item\" href=\"http://linkedin.com\">
                        <span class=\"icon icon-linkedin\"></span>
                    </a>
                </div>
                ",
            ],

            [
                'key' => 'Latest Post Count',
                'default' => 4,
            ],

            [
                'key' => 'Trending Post Count',
                'default' => 4,
            ],

            [
                'key' => 'Trending Days Limit',
                'default' => 30,
            ],

            [
                'key' => 'Limit Latest Post Per Category',
                'default' => 6,
            ],

        );

        foreach ($options_array as $option) {
            Option::create([
                'key' => $option['key'],
                'default' => $option['default']
            ]);
        }
    }
}
