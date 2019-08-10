<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CrudValidation;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use File;

class CrudController extends Controller
{   
    /**
     * Data 0 = nama
     * Data 1 = email
     * Data 2 = No hp
     * Data 3 = DOB
     * Data 4 = Gender
     * Data 5 = Photo
     * Data 6 = nama file
     */
    
    /**
     * Function index
     * @params
     * @return view admin.index
     */
    public function index(Request $request)
    {
        try {
            $data = array();
            $files = File::allFiles(storage_path('app')); 
            foreach ($files as $file) {
                if ($file->getExtension() === 'txt') {                    
                    $explode = explode(',', File::get(storage_path('app/'.$file->getBasename())));                    
                    array_push($explode, $file->getFileName());
                    array_push($data, $explode);
                }
            }            
            $number = 0;            
        } catch (\Exception $e) {
            
        }        
        return view('page.crud.index', compact('data','number'));
    }

    /**
     * Function proses store
     * @param $request
     */
    public function store(CrudValidation $request)
    {
        try {
           $imageName = '-';
           if ($request->foto) {
            $imageName = "foto-$request->name-".date('dmYhis',time()).'.'.request()->foto->getClientOriginalExtension();;
            request()->foto->move(public_path('storage'), $imageName);
           }
           $data = "$request->name,$request->email,$request->no_hp,$request->dob,$request->gender,$imageName";           
           $namaFile = "$request->name-".date('dmYhis',time());           
           Storage::put($namaFile.'.txt', $data);
           Session::flash('success','Terima Kasih Telah Mengisi Form');
        } catch (\Exception $e) {
           Session::flash('Data gagal dibuat');
        }
        return redirect()->route('crud');
    }

    /**
     * Function view update
     * @param $id
     */
    public function edit($file)
    {
        try {
            $data = explode(',',File::get(storage_path('app/'.urldecode($file))));
            array_push($data, $file);     
            return view('page.crud.edit', compact('data'));
        } catch (\Exception $e) {            
            report($e); // optional
            Session::flash('fail','Data tidak ditemukan');
            return redirect()->route('crud');
        }
    }

    /**
     * Function proses update data
     * @param validasi request, id admin
     */
    public function update(CrudValidation $request, $file)
    {
        try {            
            $data = explode(',',File::get(storage_path('app/'.urldecode($file))));            
            $imageName = $data[5];
            if ($request->foto) {
                $imageName = "foto-$request->name-".date('dmYhis',time()).'.'.request()->foto->getClientOriginalExtension();;
                request()->foto->move(public_path('storage'), $imageName);
            }            
            $dataForm = "$request->name,$request->email,$request->no_hp,$request->dob,$request->gender,$imageName";
            Storage::delete($file);
            Storage::put($file, $dataForm);
            Session::flash('success','Data berhasil diupdate');        
        } catch (\Exception $e) {       
            report($e); // optional
            Session::flash('fail','Mohon dicoba beberapa saat lagi');
        }
        return redirect()->route('crud');
    }

    /**
     * Function drop data admin
     * @param $id
     */
    public function drop($file)
    {
        try {
            Storage::delete($file);
            Session::flash('success','Data berhasil dihapus');
        } catch(\Exception $e) {
            Session::flash('fail','Data tidak ditemukan');       
        }
        return redirect()->route('crud');
    }
}
