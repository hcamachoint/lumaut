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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('signin/', 'AuthController@login');
$router->post('signup/', 'UserController@register');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/home', function () {return "Home Page";});
    $router->patch('/passchange', 'UserController@password');
    $router->get('/signout', 'AuthController@logout');
    $router->delete('/walkout', 'UserController@delete');
});
