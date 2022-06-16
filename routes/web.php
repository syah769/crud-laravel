<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//'index' tu adalah method yg dipetik dari EmployeeController. Cer bukak controller tu
Route::get('/pegawai', [EmployeeController::class, 'index'])->name('pegawai');

Route::get('/tambahpegawai', [EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');

//if nak create function untuk save data, tukar GET method kpd POST
Route::post('/insertdata', [EmployeeController::class, 'insertdata'])->name('insertdata');

//method utk retrieve data based on id
Route::get('/displaydata/{pegawaiid}', [EmployeeController::class, 'displaydata'])->name('displaydata');

// Di bwh method utk edit data. So, in conclusion: first kita kena retreive dulu data based on id dan methodnya adalah get.
// Then, barulah kita create updatepegawai dan methodnya post untuk update the data yang diretrieve
Route::post('/updatedata/{pegawaiid}', [EmployeeController::class, 'updatedata'])->name('updatedata');

//route for delete data
Route::get('/delete/{pegawaiid}', [EmployeeController::class, 'delete'])->name('delete');
