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


$router->post('auth/login', 'AuthController@userAuthenticate');

$router->group(['middleware' => 'jwt.auth'],
    function() use ($router) {
        $router->get('/', function () use ($router) {
            return $router->app->version();
        });

        $router->get('users', function() {
            $users = \App\User::all();
            return response()->json($users);
        });
    }
);
