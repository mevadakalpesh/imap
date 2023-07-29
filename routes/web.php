<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'IsAdmin'], function () {
  Route::resource('user',UserController::class);
  Route::post('user/change-status',[UserController::class,'changeUserStatus'])->name('changeUserStatus');
});

Route::get('fetch-mail',[MailController::class,'getMessages']);
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('no-access',function(Request $request){
  return view('no-access');
})->name('noAccess');