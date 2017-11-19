<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'App\Http\Middleware\VerifyAdmin', 'prefix' => 'admin'], function () {
    Route::get(
        'home',
        [
            'as'   => 'admin.home',
            'uses' => 'Admin\HomeController@index',
        ]
    );

    Route::get(
        'epidemic/resolve/{epidemic}',
        [
            'as'   => 'admin.epidemic.resolve',
            'uses' => 'Admin\EpidemicController@resolve',
        ]
    );

    Route::get(
        'epidemic/resolve/{epidemic}',
        [
            'as'   => 'admin.epidemic.resolve',
            'uses' => 'Admin\EpidemicController@resolve',
        ]
    );

    Route::get(
        'log',
        [
            'as'   => 'admin.logs',
            'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index',
        ]
    );

    Route::get(
        'epidemic/create',
        [
            'as'   => 'admin.epidemic.create',
            'uses' => 'Admin\EpidemicController@create',
        ]
    );

});
