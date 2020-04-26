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
                'value_type' =>Option::TYPE_STR
            ],
            [
                'key' => 'Landing Description',
                'default' => "Getting all the news that are trending in Kenya.",
                'value_type' =>Option::TYPE_STR
            ],

            [
                'key' => 'Contact Title',
                'default' => "Talk to us.",
                'value_type' =>Option::TYPE_STR
            ],
            [
                'key' => 'Contact Description',
                'default' => "Find our contact information and contact form.",
                'value_type' =>Option::TYPE_STR
            ],

            [
                'key' => 'Footer Title',
                'default' => "Welcome to Inatrend Kenya",
                'value_type' =>Option::TYPE_STR
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
                'value_type' =>Option::TYPE_LON
            ],

            [
                'key' => 'Latest Post Count',
                'default' => 4,
                'value_type' =>Option::TYPE_NUM
            ],

            [
                'key' => 'Trending Post Count',
                'default' => 4,
                'value_type' =>Option::TYPE_NUM
            ],

            [
                'key' => 'Trending Days Limit',
                'default' => 30,
                'value_type' =>Option::TYPE_NUM
            ],

            [
                'key' => 'Limit Latest Post Per Category',
                'default' => 6,
                'value_type' =>Option::TYPE_NUM
            ],

            [
                'key' => 'Primary Color',
                'default' => '#56c8f3',
                'value_type' =>Option::TYPE_COL
            ],

            [
                'key' => 'Primary Text Color',
                'default' => '#111111',
                'value_type' =>Option::TYPE_COL
            ],

            [
                'key' => 'Secondary Color',
                'default' => '#0D325B',
                'value_type' =>Option::TYPE_COL
            ],

            [
                'key' => 'Secondary Text Color',
                'default' => '#EEEEEE',
                'value_type' =>Option::TYPE_COL
            ],

            [
                'key' => 'Primary Button Color',
                'default' => '#029ACF',
                'value_type' =>Option::TYPE_COL
            ],

            [
                'key' => 'Secondary Button Color',
                'default' => '#434343',
                'value_type' =>Option::TYPE_COL
            ],

            [
                'key' => 'Danger Button Color',
                'default' => '#ff0000',
                'value_type' =>Option::TYPE_COL
            ],

            [
                'key' => 'Maximum Rating',
                'default' => 10,
                'value_type' =>Option::TYPE_NUM
            ],

        );

        foreach ($options_array as $option) {
            Option::create([
                'key' => $option['key'],
                'default' => $option['default'],
                'value_type' =>$option['value_type']
            ]);
        }
    }
}
