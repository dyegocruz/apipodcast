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

// $app->get('/', function () use ($app) {
//     return $app->version();
// });

$app->get('/', function () use ($app) {
    return redirect('https://www.facebook.com/benjaminstudiocriativo');
});

// $app->group(['prefix' => 'api'], function()
// {
$app->get('/itunesSearchAPI/{country}/{term}', 'ApiController@itunesSearchAPI');
$app->get('/readFeed', 'ApiController@readFeed');
// });