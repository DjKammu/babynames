<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

     $router->get('/', 'HomeController@index')->name('home');
     $router->resource('categories', CategoryController::class);
     $router->resource('countries', CoutryController::class);
     $router->resource('names', NameController::class);
     $router->resource('tags', TagController::class);

    $router->get('import/names', 'NameController@getImport')->name('names.import');
    $router->post('import/names', 'NameController@postImport')->name('post.names.import'); 

});
