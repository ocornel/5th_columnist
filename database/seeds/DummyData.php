<?php

use App\Category;
use App\Comment;
use App\Menu;
use App\MenuItem;
use App\Page;
use App\Post;
use App\Tag;
use App\Utils;
use Illuminate\Database\Seeder;
use App\User;

class DummyData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # ROLES

        # USERS
        $this->command->info('Creating Dummy Users');
        factory(User::class, 100)->create();

        # CATEGORIES

        $this->command->info('Creating Dummy Categories');
        factory(Category::class, 5)->create();

        # POSTS
        $this->command->info('Creating Dummy Posts');
        factory(Post::class, 50)->create();

        # COMMENTS
        $this->command->info('Creating Dummy Comments');
        factory(Post::class, 20)->create();

        // bellow duplicates added to show comments with parent comments
        factory(Comment::class, 40)->create();
        factory(Comment::class, 40)->create();

        # PAGES
        $this->command->info('Creating Dummy Pages');
        factory(Page::class, 10)->create();

        # TAGS
        $this->command->info('Creating Dummy Tags');
        factory(Tag::class, 50)->create();

        # MENUS
        $this->command->info('Creating Dummy Menus');
        factory(Menu::class, 3)->create();

        # MENU ITEMS
        $this->command->info('Creating Dummy Menu Items');
        factory(MenuItem::class, 20)->create();

        # RESOLVE STUFF
        $this->command->info('Resolving Stuff');
        Utils::ResolveStuff();

    }
}
