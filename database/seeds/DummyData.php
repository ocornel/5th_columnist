<?php

use App\Category;
use App\Comment;
use App\Menu;
use App\MenuItem;
use App\Page;
use App\Post;
use App\PostMeta;
use App\Tag;
use App\UserMeta;
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
//        ini_set('memory_limit', '256M');
        # ROLES

        # USERS
        if ($this->command) $this->command->info('Creating Dummy Users');
        factory(User::class, 10)->create();

        # USER META
        if ($this->command) $this->command->info('Creating Dummy User Meta');
        factory(UserMeta::class, 40)->create();

        # CATEGORIES
        if ($this->command) $this->command->info('Creating Dummy Categories');
        factory(Category::class, 5)->create();

        # TAGS

        if ($this->command) $this->command->info('Creating Dummy Tags');
        factory(Tag::class, 50)->create();

        # POSTS
        if ($this->command) $this->command->info('Creating Dummy Posts');
        factory(Post::class, 50)->create();

        # POST META
        if ($this->command) $this->command->info('Creating Dummy Post Meta');
        factory(PostMeta::class, 200)->create();

        # COMMENTS
        if ($this->command) $this->command->info('Creating Dummy Comments');
        factory(Post::class, 20)->create();

        // bellow duplicates added to show comments with parent comments
        factory(Comment::class, 50)->create();
        factory(Comment::class, 100)->create();

        # PAGES
        if ($this->command) $this->command->info('Creating Dummy Pages');
        factory(Page::class, 10)->create();

        # MENUS
        if ($this->command) $this->command->info('Creating Dummy Menus');
        factory(Menu::class, 3)->create();

        # MENU ITEMS
        if ($this->command) $this->command->info('Creating Dummy Menu Items');
        factory(MenuItem::class, 20)->create();

        # RESOLVE STUFF
        if ($this->command) $this->command->info('Resolving Stuff');
        Utils::ResolveStuff();

    }
}
