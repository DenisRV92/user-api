<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Route::get('user', [API\ApiController::class,'user'])->middleware('auth:api');
Route::group([
    'prefix' => 'requests',
//    'middleware' => 'auth:api'
], function () {
    Route::post('register', [Api\UserController::class, 'register']);
    Route::group([
        'middleware' => ['auth:sanctum']
    ], function () {
        Route::get('', [Api\ApiController::class, 'index']);
        Route::post('',[Api\ApiController::class, 'store']);
        Route::put('{application}', [Api\ApiController::class, 'update']);
        Route::get('filters/{status}', [Api\ApiController::class, 'filter'])
            ->where('status', '(active|resolved)');
    });
});
