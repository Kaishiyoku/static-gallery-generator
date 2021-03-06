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

use Illuminate\Support\Facades\Artisan;
use Laravel\Lumen\Routing\Router;

/**
 * @var Router $router
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

if ($router->app->environment() !== 'production') {
    $router->get('/build', function () use ($router) {
        Artisan::call('galleries:build');

        return Artisan::output();
    });
}
