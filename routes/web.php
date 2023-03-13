<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ApplicationFormController;
use App\Http\Controllers\EmployeeController;

use App\Exports\NotificationExport;
use App\Http\Controllers\ExtraHourController;
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
    return view('/dashboard');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
->group(function () {
    Route::get('/notifications/create', function () {
        return view('notifications.create');
    });

    Route::get('/statistics',[ApplicationFormController::class,'summary'])->name('statistics');

    Route::resource('notifications',NotificationController::class)->names('notifications');
    Route::resource('employees', EmployeeController::class)->names('employees');
    Route::resource('extraHours',ExtraHourController::class)->names('extrahours');

    Route::get('/excel/{f_inicio?}/{f_fecha?}', function ($f_inicio = "",$f_final = "") {
        return Excel::download(new NotificationExport($f_inicio,$f_final), 'novedades.xlsx');
    });


    Route::get('get/{filename}', [NotificationController::class, 'getfile'])->name('getfile');

});

Route::get('/employeepdf', [EmployeeController::class, 'createPDF'])->name('employeepdf');
Route::get('/allemployeepdf', [EmployeeController::class, 'allPDF'])->name('allemployeepdf');

Route::get('/estadisticapdf', [ApplicationFormController::class, 'estadisticasPDF'])->name('estadisticapdf');

Route::match(['get', 'post'], 'register', function(){ return redirect('/login'); });
Route::match(['get'], '/dashboard', function(){ return redirect('/notifications/create'); });

Route::resource('applicationForms', ApplicationFormController::class)->names('applicationForms');


Route::get('/pdf/{$id}',[EmployeeController::class,'imprimirtest'])->name('imprimir');
