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

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::group(['middleware' => ['auth', 'active.user']], function () {
  Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
  Route::get('/bulkdownload', [EmployeeController::class, 'bulkDownloadPage'])->name('bulkdownload');
  Route::get('/generate-id/bulk-download', [EmployeeController::class, 'bulkDownload'])->name('generate-id.bulk-download');
  Route::get('/generate-id/{generateId}/download', [EmployeeController::class, 'download'])->name('generate-id.download');
  Route::patch('generate-id/{generateId}/toggle-status', [EmployeeController::class, 'toggleStatus'])->name('generate-id.toggle-status');
  Route::resource('generate-id', EmployeeController::class);

  Route::group(['middleware' => ['admin']], function () {
    Route::patch('user/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('user.toggle-status');
    Route::patch('corporation/{corporation}/toggle-status', [CorporationController::class, 'toggleStatus'])->name('corporation.toggle-status');
    Route::patch('zone/{zone}/toggle-status', [ZoneController::class, 'toggleStatus'])->name('zone.toggle-status');
    Route::patch('constituency/{constituency}/toggle-status', [ConstituencyController::class, 'toggleStatus'])->name('constituency.toggle-status');
    Route::patch('ward/{ward}/toggle-status', [WardController::class, 'toggleStatus'])->name('ward.toggle-status');
    Route::patch('department/{department}/toggle-status', [DepartmentController::class, 'toggleStatus'])->name('department.toggle-status');
    Route::patch('designation/{designation}/toggle-status', [DesignationController::class, 'toggleStatus'])->name('designation.toggle-status');

    Route::get('/version/index', function () {
      return view('admin.version.index');
    })->name('version.index');
    Route::get('/version/create', function () {
      return view('admin.version.create');
    })->name('version.create');
    Route::get('/version/show', function () {
      return view('admin.version.show');
    })->name('version.show');

    Route::resources([
      'corporation' => CorporationController::class,
      'zone' => ZoneController::class,
      'constituency' => ConstituencyController::class,
      'ward' => WardController::class,
      'user' => UserController::class,
      'department' => DepartmentController::class,
      'designation' => DesignationController::class,
    ]);
  });
});

Route::get('/clear-cache', function () {
  \Artisan::call('cache:clear');
  \Artisan::call('route:clear');
  \Artisan::call('config:clear');
  \Artisan::call('view:clear');
  echo 'All caches cleared successfully!';
});

Route::get('/forgot', function () {
  return view('auth.forgot');
})->name('forgot');
