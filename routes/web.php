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

$router->post("/wilayah","WilayahController@create");
$router->get("/wilayah","WilayahController@read");
$router->get("/wilayah/{id}","WilayahController@detail");
$router->put("/wilayah/{id}","WilayahController@update");
$router->delete("/wilayah/{id}","WilayahController@delete");

$router->post("/sinder","SinderController@register");
$router->get("/sinder","SinderController@read");
$router->get("/sinder/{id}","SinderController@detail");
$router->put("/sinder/{id}","SinderController@update");
$router->delete("/sinder/{id}","SinderController@delete");

$router->post("/kebun","KebunController@create");
$router->get("/kebun","KebunController@read");
$router->get("/kebun/{id}","KebunController@detail");
$router->put("/kebun/{id}","KebunController@update");
$router->delete("/kebun/{id}","KebunController@delete");

$router->post("/login","UserController@login");
$router->get("/logout/{id}","UserController@logout");
$router->post("/loginAllUser","UserController@loginAllUser");

$router->put("/taksasi/{id}","TaksasiController@update");
$router->get("/taksasi","TaksasiController@read");
$router->get("/taksasi/{id}","TaksasiController@detail");

$router->get("/laporan","LaporanController@read");
$router->get("/laporan/{id}","LaporanController@detail");

$router->get("/print/{id}","LaporanController@excel");

$router->get('/excel', function ()  {
    return view('excel');
});

