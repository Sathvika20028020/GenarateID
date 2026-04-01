<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorporationController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\ConstituencyController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resources([
      'corporation'                     => CorporationController::class,
      'zone'                            => ZoneController::class,
      'constituency'                    => ConstituencyController::class,
      'ward'                            => WardController::class,
      'user'                            => UserController::class,
      'department'                      => DepartmentController::class,
      'designation'                     => DesignationController::class,
      'generate-id'                     => EmployeeController::class,
    ]);
});

Route::get('/clear-cache', function () {
  \Artisan::call('cache:clear');
  \Artisan::call('route:clear');
  \Artisan::call('config:clear');
  \Artisan::call('view:clear');
  echo 'All caches cleared successfully!';
});




// Route::get('/', function () {
//     return view('admin.dashboard');
// })->name('dashboard');





Route::get('/genarateedit', function () {
    return view('admin.generate.edit'); 
})->name('genarateedit');



Route::get('/genarateshow', function () {
    return view('admin.generate.show'); 
})->name('genarateshow');
Route::get('/bulkdownload', function () {
    return view('admin.generate.bulkdownload'); 
})->name('bulkdownload');





Route::get('/forgot', function () {
    return view('auth.forgot');
  })->name('forgot');