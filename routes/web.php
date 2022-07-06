<?php

use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
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
    //function ni untuk kira berapa org user, kalau dlm native kita guna SELECT COUNT(id) bagai, so dalam laravel lain sikit:
    $jumlahpegawai = Employee::count();
    $lelaki = Employee::where('gender', 'man')->count(); //if native, we code like SELECT COUNT bla3 WHERE gender = 'man' something like that la
    $perempuan = Employee::where('gender', 'woman')->count(); //so... gender ni dari table db dan man/woman adalah value dalam column gender tu


    // return view('welcome');
    return view('welcome', compact('jumlahpegawai', 'lelaki', 'perempuan'));
    //asalnya return view welcome je, tapi sebab kita nak return variable jumlahpegawai tu jugak, so tambahlah compact bla3 bagai
    //variable jumlahpegawai akan direcall dekat welcome.blade.php line 26
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

//route utk export to pdf file guna library DomPdf. Function exportpdf() di Employeecontroller, refer line 77
Route::get('/exportpdf', [EmployeeController::class, 'exportpdf'])->name('exportpdf');

//export excel
Route::get('/exportexcel', [EmployeeController::class, 'exportexcel'])->name('exportexcel');

//import excel
Route::post('/importexcel', [EmployeeController::class, 'importexcel'])->name('importexcel');
