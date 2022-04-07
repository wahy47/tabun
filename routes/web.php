<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->post("/rayon","RayonController@create");
$router->get("/rayon","RayonController@read");
$router->get("/rayon/{id}","RayonController@detail");
$router->put("/rayon/{id}","RayonController@update");
$router->delete("/rayon/{id}","RayonController@delete");

$router->post("/register","UserController@register");
$router->post("/login","UserController@login");
