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

if (App::environment('production', 'staging')) {
URL::forceScheme('https');
}

Route::get('/','NameController@index');

Route::get('/baby-names/{cat}','NameController@names')->name('baby-names');

Route::get('/baby-name/{gender}/{slug}','NameController@getName')->name('baby-name');

Route::get('/baby-names/{cat}/{gender}/{letter}','NameController@getNames')
->name('baby-names.letter');

Route::get('/baby-names/{cat}/{gender}/{term}/{word}','NameController@searchNames')
->name('baby-names.search');

// Route::get('/cache-clear', function () {
//     Artisan::call('config:clear');
//     Artisan::call('cache:clear');
//     Artisan::call('view:clear');
// });

// Route::get('search/{slug}.xml', [
//   'uses' => 'SitemapController@search'
// ])->where('slug','.*');

// Route::get('search/{slug}', [
//   'uses' => 'NameController@search'
// ])->where('slug','.*');


// Route::get('{tc}/{slug}', [
//   'uses' => 'NameController@tagOrigin'
// ])->where('slug', '([A-Za-z0-9\-\/]+)');


// Route::get('{slug}', [
//   'uses' => 'NameController@lyrichord'
// ])->where('slug', '([A-Za-z0-9\-\/]+)');


// /*SITE MAP */
// Route::get('/sitemap/index.xml', 'SitemapController@index');
// Route::get('/sitemap/categories.xml', 'SitemapController@categories');
// Route::get('/sitemap/tags.xml', 'SitemapController@tags');
// Route::get('/sitemap/origins.xml', 'SitemapController@origins');

// Route::get('{tc}.xml', [
//   'uses' => 'SitemapController@tagsCateogries'
// ])->where('slug', '([A-Za-z0-9\-\/]+)');

// Route::get('{tc}/{slug}.xml', [
//   'uses' => 'SitemapController@tagCateogry'
// ])->where('slug', '([A-Za-z0-9\-\/]+)');

// Route::get('{slug}.xml', [
//   'uses' => 'SitemapController@lyrichord'
// ])->where('slug', '([A-Za-z0-9\-\/]+)');