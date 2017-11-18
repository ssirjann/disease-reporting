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

$router->get(
    '/register',
    [
        'as'   => 'api.register',
        'uses' => 'UserController@register',
    ]
);

$router->get(
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

        $router->get(
            'report',
            [
                'as'   => 'api.report',
                'uses' => 'ReportController@create',
            ]
        );

        $router->get(
            'disease/trending',
            [
                'as'   => 'api.disease.trending',
                'uses' => 'ReportController@trending',
            ]
        );

        $router->get(
            'disease/history',
            [
                'as'   => 'api.disease.history',
                'uses' => 'ReportController@history',
            ]
        );

        $router->get(
            'disease/unverified',
            [
                'as'   => 'api.disease.unverified',
                'uses' => 'ReportController@unverified',
            ]
        );

        $router->get(
            'suggestion',
            [
                'as'   => 'api.suggestion',
                'uses' => 'ReportController@addSuggestion',
            ]
        );
    });
