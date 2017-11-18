<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function() {
    return '1';
});

$router->group(
    ['middleware' => 'auth:api'],
    function ($router) {

        $router->get(
          '/',
          function () {
              return 1;
          }
        );

        $router->post(
            'login',
            [
                'as'   => 'api.monitor',
                'uses' => 'Api\Monitor\MonitorController@getMonitorLoginData',
            ]
        );

        $router->get(
            'user',
            function (Request $request) {
                return $request->user();
            }
        );
    });
