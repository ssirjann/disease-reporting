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

$router->post(
    '/register',
    [
        'as'    => 'api.register',
        'uses' => 'UserController@register',
    ]
);

$router->post(
    'login',
    [
        'as'   => 'api.monitor',
        'uses' => 'UserController@login',
    ]
);

$router->group(
    ['middleware' => 'auth:api'],
    function ($router) {

        $router->get(
            'user',
            function (Request $request) {
                return $request->user();
            }
        );

        $router->post(
            'report',
            [
                'as'   => 'api.report',
                'uses' => 'ReportController@create',
            ]
        );
    });
