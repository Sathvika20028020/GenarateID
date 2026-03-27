<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorporationController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\ConstituencyController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;

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



Route::get('/genaratelist', function () {
    return view('admin.genarate.list'); 
})->name('genaratelist');

Route::get('/genarateedit', function () {
    return view('admin.genarate.edit'); 
})->name('genarateedit');

Route::get('/genaratecreate', function () {
    return view('admin.genarate.create'); 
})->name('genaratecreate');

Route::get('/genarateshow', function () {
    return view('admin.genarate.show'); 
})->name('genarateshow');
Route::get('/bulkdownload', function () {
    return view('admin.genarate.bulkdownload'); 
})->name('bulkdownload');


Route::get('/departmentlist', function () {
    return view('admin.department.list'); 
})->name('departmentlist');

Route::get('/departmentcreate', function () {
    return view('admin.department.create'); 
})->name('departmentcreate');

Route::get('/departmentedit', function () {
    return view('admin.department.edit'); 
})->name('departmentedit');

Route::get('/departmentshow', function () {
    return view('admin.department.show'); 
})->name('departmentshow');


Route::get('/designationlist', function () {
    return view('admin.designation.list'); 
})->name('designationlist');

Route::get('/designationcreate', function () {
    return view('admin.designation.create'); 
})->name('designationcreate');

Route::get('/designationedit', function () {
    return view('admin.designation.edit'); 
})->name('designationedit');

Route::get('/designationshow', function () {
    return view('admin.designation.show'); 
})->name('designationshow');

Route::get('/userslist', function () {
    return view('admin.users.list'); 
})->name('userslist');

Route::get('/userscreate', function () {
    return view('admin.users.create'); 
})->name('userscreate');

Route::get('/usersedit', function () {
    return view('admin.users.edit'); 
})->name('usersedit');

Route::get('/usersshow', function () {
    return view('admin.users.show'); 
})->name('usersshow');



Route::get('/wardlist', function () {
    return view('admin.ward.list'); 
})->name('wardlist');

Route::get('/wardcreate', function () {
    return view('admin.ward.create'); 
})->name('wardcreate');

Route::get('/wardedit', function () {
    return view('admin.ward.edit'); 
})->name('wardedit');

Route::get('/wardshow', function () {
    return view('admin.ward.show'); 
})->name('wardshow');



Route::get('/zonelist', function () {
    return view('admin.zone.list'); 
})->name('zonelist');

Route::get('/zonecreate', function () {
    return view('admin.zone.create'); 
})->name('zonecreate');

Route::get('/zoneedit', function () {
    return view('admin.zone.edit'); 
})->name('zoneedit');

Route::get('/zoneshow', function () {
    return view('admin.zone.show'); 
})->name('zoneshow');


Route::get('/corporationlist', function () {
    return view('admin.corporation.list');
})->name('corporationlist');

Route::get('/corporationcreate', function () {
    return view('admin.corporation.create');
})->name('corporationcreate');

Route::get('/corporationedit', function () {
    return view('admin.corporation.edit');
})->name('corporationedit');

Route::get('/corporationshow', function () {
    return view('admin.corporation.show');
})->name('corporationshow');

