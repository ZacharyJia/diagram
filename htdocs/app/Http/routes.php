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

$app->get('/', 'Controller@hello');


$app->group(['prefix' => 'auto', 'namespace' => 'App\Http\Controllers'], function ()  use ($app) {

    $app->get('list', 'AutoController@getList');

    $app->get('data', 'AutoController@getData');

    $app->get('/', function() {
        return view('auto');
    });
});


$app->group(['prefix' => 'manual', 'namespace' => 'App\Http\Controllers'], function ()  use ($app) {

    $app->get('list', 'ManualController@getList');

    $app->get('data', 'ManualController@getData');

    $app->get('/', function() {
        return view('manual');
    });

    $app->get('/add', 'ManualController@addDataView');

    $app->post('/insert', 'ManualController@insertData');
});