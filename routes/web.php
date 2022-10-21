<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ApplicationFormController;
use App\Http\Controllers\EmployeeController;

use App\Exports\NotificationExport;

use App\Models\Employee;
use Maatwebsite\Excel\Facades\Excel;

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
    return view('applicationForms.index');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
->group(function () {
    Route::get('/notifications/create', function () {
        return view('notifications.create');
    });

    Route::get('/statistics',[ApplicationFormController::class,'summary']);

    Route::resource('notifications',NotificationController::class)->names('notifications');

    Route::get('/excel', function () {
        return Excel::download(new NotificationExport, 'novedades.xlsx');
    });

    Route::resource('employees', EmployeeController::class)->names('employees');
});

Route::get('/employeepdf', [EmployeeController::class, 'createPDF'])->name('employeepdf');

Route::match(['get', 'post'], 'register', function(){ return redirect('/login'); });
Route::match(['get'], '/dashboard', function(){ return redirect('/notifications/create'); });

Route::resource('applicationForms', ApplicationFormController::class)->names('applicationForms');


Route::get('/pdf/{$id}',[EmployeeController::class,'imprimirtest'])->name('imprimir');
