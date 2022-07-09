<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    //function for index
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Employee::where('name', 'LIKE', '%' . $request->search . '%');
            Session::put('halaman_url', request()->fullUrl());
        } else {
            //apa yg aku fhm Employee:all() ni mcm kita fetch all data
            //$data = Employee::all(); // -> if nak display data, so kena import model Employee. Cer igt, model fungsinya to save database/data
            //dan utk yg terbaik supaya data tak loading berat, kita fetch based on pagination
            $data = Employee::paginate(5); //-> dia akan display 5 yang utama dekat page depan. Sila refer datapegawai.blade.php, line 75. Related tau
            Session::put('halaman_url', request()->fullUrl());
        }

        return view('datapegawai', compact('data'));
        //so, we return the datapegawai.blade.php because it's for View function and recall again the variable $data -> compact('data) hasil dari fetch all tu
        //variable $data akan dipanggil semula dekat View (datapegawai.blade.php. Sila rujuk )
    }

    public function tambahpegawai()
    {
        return view('tambahdata');
    }

    //fungsi Request adalah utk menangkap data yang dihantar dari form. Request ini digunakan utk penerimaan data dari input form
    public function insertdata(Request $request)
    {

        //create valiation form based on video 22
        //$this->validate($request) bermaksud kita nak buat validation tu based on variable request
        //nak tampilkan error pulak, tgk tambahdata.blade.php line 21
        $this->validate($request, [
            'name' => 'required|min:7|max:20',
            'phoneno' => 'required|min:11|max:12',
        ]);


        //syntax to insert the data into db
        $data = Employee::create($request->all()); //request kesemua data dari form (full name, gender dan phone no)

        //ini adalah syntax untuk insert gmbr ke dlm db
        if ($request->hasFile('photo')) {
            $request->file('photo')->move('photopegawai/', $request->file('photo')->getClientOriginalName());
            $data->photo = $request->file('photo')->getClientOriginalName();
            $data->save();
        }

        //return after add data. Dia akan return ke routes pegawai
        return redirect('/pegawai')->with('success', 'Data Successfully Inserted');
        //cmna aku nk ckp eh yg with ni. Kalau hg perasan dekat php native, dia mcm popup default by php. Ha camtu lah. Dan dia jugak umpama mcm session.
        //So, tgk dekat datapegawai.blade.php, kat situ kita recall & get semula variable 'success'
    }

    public function displaydata($pegawaiid)
    {
        //create new variable, then recall model and then retrieve data based on id
        $data = Employee::find($pegawaiid);

        return view('displaydata', compact('data')); //ambik semula variable $data tu
    }

    public function updatedata(Request $request, $pegawaiid)
    {
        $data = Employee::find($pegawaiid);
        $data->update($request->all()); //kita request supaya semua data diupdate
        if(session('halaman_url')) {
            return redirect(session('halaman_url'))->with('success', 'Data successfully updated');
        }
        if ($request->hasFile('photo')) {
            $request->file('photo')->move('photopegawai/', $request->file('photo')->getClientOriginalName());
            $data->photo = $request->file('photo')->getClientOriginalName();
            $data->save();
        }
        return redirect('/pegawai')->with('success', 'Data Successfully Updated');
    }

    public function delete($pegawaiid)
    {
        //delete based on id
        $data = Employee::find($pegawaiid);
        $data->delete();
        return redirect('/pegawai')->with('success', 'Data Successfully Deleted');
    }

    //function untuk export pdf
    public function exportpdf()
    {
        //ia akan export semua data employee sebab kita dah ambil/fetch semua data
        $data = Employee::all();
        view()->share('data', $data);
        $pdf = PDF::loadView('datapegawai-pdf');
        return $pdf->download('listpegawai.pdf');
    }

    //export to excel
    public function exportexcel()
    {
        //aku create new class iaitu EmployeeExport di mana class EmployeeExport ni basednya adalah model Employee
        //return Excel ini adalah aku import library nya
        return Excel::download(new EmployeeExport, 'datapegawai.xlsx');
    }

    public function importexcel(Request $request)
    {
        $data = $request->file('file'); //data akan request "benda" yang berupa file dengan name nya adalah file
        $filename = $data->getClientOriginalName();
        $data->move('PegawaiData', $filename);
        Excel::import(new EmployeeImport, public_path('/PegawaiData/' . $filename));
        return \redirect()->back();
    }
}

/* nota:
setiap method post yang kita tgk dari route (web.php), kita akan perasan dekat function dan method akan ada Request $request.
Cer tgk kat atas nama method dari function masing2, dan tgk dkat web.php . Hg boleh tau guna method post or get
*/