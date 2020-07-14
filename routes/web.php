<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

/**
 * @var  Laravel\Lumen\Routing\Router $router
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->group(['prefix' => 'users-types'], function () use ($router) {
        $router->get('/', 'UsersTypesController@index');
        $router->get('/{id}', 'UsersTypesController@show');        
        $router->post('/', 'UsersTypesController@store');
        $router->put('/{id}', 'UsersTypesController@update');
        $router->delete('/{id}', 'UsersTypesController@destroy');
    });
});
