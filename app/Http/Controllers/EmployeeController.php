<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //function for index
    public function index()
    {
        //apa yg aku fhm Employee:all() ni mcm kita fetch all data
        $data = Employee::all(); //if nak display data, so kena import model Employee. Cer igt, model fungsinya to save database/data
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
}
