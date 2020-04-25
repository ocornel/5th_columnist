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
Route::get('prepare_dummy', 'BlogController@prepare_dummy')->name('prepare_dummy'); # todo move this to admin side once done
Route::get('delete_dummy', 'BlogController@delete_dummy')->name('delete_dummy'); # todo move this to admin side once done


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
