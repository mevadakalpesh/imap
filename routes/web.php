<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BrandCategoryController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\CarTypeController;
use App\Http\Controllers\EngineTypeController;
use App\Http\Controllers\UserCarController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Models\Quotation;
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
  Route::resource('user', UserController::class);
  Route::resource('service', ServiceController::class);
  Route::resource('brand', BrandController::class);
  Route::resource('category', CategoryController::class);
  Route::resource('part', PartController::class);
  Route::resource('car-type', CarTypeController::class);
  Route::resource('engine-type', EngineTypeController::class);
  Route::resource('user-car', UserCarController::class);
  Route::resource('invoice', InvoiceController::class);
  Route::resource('quotation', QuotationController::class);
  Route::post('delete-field', [InvoiceController::class,'deleteField'])->name('deleteField');
  
  Route::get('about-us',[AboutUsController::class,'aboutUs'])->name('aboutUs');
  Route::post('about-us-update',[AboutUsController::class,'aboutUsUpdate'])->name('aboutUsUpdate');
  
  Route::get('term-condition',[AboutUsController::class,'termCondition'])->name('termCondition');
  
  
  Route::post('get-sub-car-by-id', [UserCarController::class, 'getSubCarById'])->name('getSubCarById');
  Route::post('change-user-status', [UserCarController::class, 'changeUserStatus'])->name('change-user-status');
  Route::resource('brand-category', BrandCategoryController::class);
  Route::post('user/change-status', [UserController::class, 'changeUserStatus'])->name('changeUserStatus');
});

Route::get('noAccess', function (Request $request) {
  return view('no-access');
})->name('noAccess');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("api-login", function (Request $request) {
  Artisan::call('down');
});

Route::get("cc", function (Request $request) {
  Artisan::call('optimize');
  Artisan::call('cache:clear');
  Artisan::call('config:clear');
  Artisan::call('route:clear');
  Artisan::call('view:clear');
  dd('done');
});

Route::get("migrate", function (Request $request) {
  Artisan::call('migrate');
});


Route::get('/generate-pdf', [InvoiceController::class,'generatePDF'])->name('generatePDF');


Route::get('kapu',function (){
  
  $invoice = Quotation::with(['fields'])->find(1);
  return view('pdf.quotation',[
    'quotation' => $invoice
  ]);
  
});
  
/******
Route::get('change-permissions', function () {
$publicPath = public_path();
// Set directories to 755 and files to 644
chmod($publicPath, 0755);
recursivelySetPermissions($publicPath, 0755, 0644);

// Make sure storage and cache directories are writable
chmod(storage_path(), 0775);
chmod(base_path('bootstrap/cache'), 0775);

return "Permissions changed successfully.";
});

function recursivelySetPermissions($path, $dirPermissions, $filePermissions) {
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
foreach ($iterator as $item) {
if ($item->isDir()) {
chmod($item, $dirPermissions);
} else {
chmod($item, $filePermissions);
}
}
}
*****/


Auth::routes();