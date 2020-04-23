<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Default Categories');

        $categories = [Category::UNCATEGORIEZED,'Politics', 'Sports', 'Lifestyle', 'Entertainment'];
        foreach ($categories as $category) {
            Category::create(
                ['name'=>$category]);
        }
    }
}
