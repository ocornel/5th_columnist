<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

# public pages
Route ::get('/', 'BlogController@landing')->name('landing');
Route ::get('about', 'BlogController@landing')->name('about');
Route ::get('contact', 'BlogController@landing')->name('contact');
Route ::get('mi/{menu_item}', 'BlogController@load_menu_item')->name('load_menu_item');
Route ::get('page_{page}/{page_name?}', 'BlogController@load_page')->name('load_page');
Route ::get('post_toggle{post}/{post_name?}', 'BlogController@post_toggle')->name('post_toggle');
Route ::get('post_{post}/{post_name?}', 'BlogController@load_post')->name('load_post');
Route ::post('post_comment/{post}', 'BlogController@post_comment')->name('post_comment');
Route ::get('author_{user}/{author_name?}', 'BlogController@load_author')->name('load_author');
Route ::get('cat_{category}/{category_name?}/{post_id?}/', 'BlogController@load_category')->name('load_category');
Route ::get('tag_{tag}/{tag_name?}/', 'BlogController@load_tag')->name('load_tag');
Route::get('prepare_dummy', 'BlogController@prepare_dummy')->name('prepare_dummy');
Route::get('delete_dummy', 'BlogController@delete_dummy')->name('delete_dummy');
Route::get('template_code', 'BlogController@template_code')->name('template_code');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/charts', 'HomeController@charts')->name('charts');
Route::get('/reports', 'HomeController@reports')->name('reports');

# PAGES
Route::get('/pages', 'PageController@pages')->name('pages');
Route::get('/create_page', 'PageController@create_page')->name('create_page');
Route::post('/store_page', 'PageController@store_page')->name('store_page');
Route::post('/update_page/{page}', 'PageController@update_page')->name('update_page');
Route::get('/show_page/{page}/{page_name?}', 'PageController@show_page')->name('show_page');
Route::get('/edit_page/{page}/{page_name?}', 'PageController@edit_page')->name('edit_page');
Route::get('/delete_page/{page}', 'PageController@delete_page')->name('delete_page');

# MENUS
Route::get('/menus', 'MenuController@menus')->name('menus');
Route::post('/store_menu', 'MenuController@store_menu')->name('store_menu');
Route::get('/edit_menu/{menu}/{menu_name?}', 'MenuController@edit_menu')->name('edit_menu');
Route::get('/delete_menu/{menu}', 'MenuController@delete_menu')->name('delete_menu');


# CATEGORIES
Route::get('/categories/{status?}', 'CategoryController@categories')->name('categories');
Route::get('/create_category', 'CategoryController@create')->name('create_category');
Route::post('/store_category', 'CategoryController@store')->name('store_category');
Route::post('/update_category/{category}', 'CategoryController@update')->name('update_category');
Route::get('/show_category/{category}/{category_name?}', 'CategoryController@show')->name('show_category');
Route::get('/edit_category/{category}/{category_name?}', 'CategoryController@edit')->name('edit_category');
Route::get('/delete_category/{category}', 'CategoryController@destroy')->name('delete_category');

# TAGS
Route::get('/tags', 'TagController@tags')->name('tags');

# POSTS
Route::get('/posts/{status?}/{category?}', 'PostController@posts')->name('posts');
Route::get('/create_post', 'PostController@create')->name('create_post');
Route::post('/store_post', 'PostController@store')->name('store_post');
Route::post('/update_post/{post}', 'PostController@update')->name('update_post');
Route::get('/show_post/{post}/{post_name?}', 'PostController@show')->name('show_post');
Route::get('/edit_post/{post}/{post_name?}', 'PostController@edit')->name('edit_post');
Route::get('/delete_post/{post}', 'PostController@destroy')->name('delete_post');

# COMMENTS
Route::get('/comments/{status?}', 'CommentController@comments')->name('comments');

# ROLES
Route::get('/roles', 'RoleController@roles')->name('roles');

# USERS
Route::get('/users/{role?}', 'UserController@users')->name('users');
Route::get('/show_user/{user}/{user_name?}', 'UserController@show_user')->name('show_user');

# OPTIONS
Route::get('/settings/{type?}', 'OptionController@options')->name('options');
