<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('confirm/{token}', ['as' => 'confirmation', 'uses' => 'UserController@confirmation']);
$router->post('signin/', ['as' => 'signin', 'uses' => 'AuthController@login']);
$router->post('signup/', ['as' => 'signup', 'uses' => 'UserController@register']);

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/home', function () {return "Home Page";});
    $router->patch('/passchange', ['as' => 'passchange', 'uses' => 'UserController@password']);
    $router->get('/signout', ['as' => 'signout', 'uses' => 'AuthController@logout']);
    $router->delete('/walkout', ['as' => 'walkout', 'uses' => 'UserController@delete']);
});
