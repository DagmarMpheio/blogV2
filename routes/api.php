<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Vue js Api Route and Upload api Route
/*Route::apiResources(
    [
        'user' => 'API\UserController',
        'photo' => 'API\PhotoController',
        'singer' => 'API\SingerController',
        'singer2' => 'SingerInfoController',
        'grupo' => 'API\GrupoCoralController',
    ]
);*/

////api upload
//Route::apiResources(
//    [
//        'photo' => 'API\PhotoController'
//    ]
//);

