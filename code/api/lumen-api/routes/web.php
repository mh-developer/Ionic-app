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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/', 'AdController@index');

/**
 * Ad routs
 */
$router->get   ('ads'    , 'AdController@index');
$router->get   ('ad/{id}', 'AdController@show');
$router->patch ('ad/{id}', 'AdController@update');
$router->post  ('ad'     , 'AdController@create');
$router->delete('ad/{id}', 'AdController@destroy');


/**
 * Auth routs
 */
$router->group([
    // 'middleware' => 'api',
    'prefix' => 'auth'
], function() use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login'   , 'AuthController@login');
    $router->post('logout'  , 'AuthController@logout');
    $router->post('refresh' , 'AuthController@refresh');
    $router->post('me'      , 'AuthController@me');
});
