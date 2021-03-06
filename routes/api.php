<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TownController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CenterOfInterest;
use App\Http\Controllers\Api\V1\SpaceCategoryController;
use App\Http\Controllers\Api\V1\SpaceController;
use App\Http\Controllers\Api\V1\MenuController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function(){


        Route::resource('towns', TownController::class);
        Route::resource('centerofinterests', CenterOfInterest::class);
        Route::resource('spacecategories', SpaceCategoryController::class);
        Route::resource('spaces', SpaceController::class);
        Route::resource('menus', MenuController::class);



    Route::post('logout', [AuthController::class, 'logout']);

});

Route::get('/', [CoreController::class, 'home'])->middleware('auth:sanctum');
