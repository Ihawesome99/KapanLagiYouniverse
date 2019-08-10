<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\AdminValidation;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminController extends Controller
{   
    
    /**
     * Function index
     * @params
     * @return view admin.index
     */
    public function index(Request $request)
    {
        try {
            $data = User::query();
            // check jika ada search
            if (!empty($request->search)) {
                $data = $data->where('email', $request->email);
            }
            // jumlah data per page
            $pagination = 5;
            $data = $data->paginate($pagination);

            // Handle number perpindahan page
            $number = 0; // Default page
            if (request()->has('page') && request()->get('page') > 1) {
                $number += (request()->get('page') - 1) * $pagination ;
            }
        } catch (\Exception $e) {

        }
        return view('page.admin.index', compact('data','number'));
    }

    /**
     * Function proses store
     * @param $request
     */
    public function store(AdminValidation $request)
    {        
        try {
            User::create([
                'name' => $request->name,
                'password' => \Hash::make($request->password),
                'email' => $request->email
            ]);
            Session::flash('success','Data berhasil dibuat');
        } catch (\Exception $e) {
            Session::flash('Data gagal dibuat');            
        }
        return redirect()->route('admin');
    }

    /**
     * Function view update
     * @param $id
     */
    public function edit($id)
    {
        try {
            $data = User::where('id', $id)->firstOrFail();
            return view('page.admin.edit', compact('data'));
        } catch (\Exception $e) {
            if ($e instanceOf ModelNotFoundException) {
                Session::flash('fail','Data tidak ditemukan');
            } else {
                report($e); // optional
                Session::flash('fail','Mohon dicoba beberapa saat lagi');
            }
            return redirect()->route('admin');
        }
    }

    /**
     * Function proses update data
     * @param validasi request, id admin
     */
    public function update(AdminValidation $request, $id)
    {
        try {
            $data = User::where('id', $id)->firstOrFail();
            if ($request->password) {
                $password = \Hash::make($request->password);
            } else {
                $password = $data->password;
            }
            User::where('id',$id)->update([
                'name' => $request->name,
                'password' => $password,
                'email' => $request->email
            ]);
            Session::flash('success','Data berhasil diupdate');
            return redirect()->route('admin');
        } catch (\Exception $e) {
            if ($e instanceOf ModelNotFoundException) {
                Session::flash('fail','Data tidak ditemukan');
            } else {
                report($e); // optional
                Session::flash('fail','Mohon dicoba beberapa saat lagi');
            }
            return redirect()->route('admin');
        }
    }

    /**
     * Function drop data admin
     * @param $id
     */
    public function drop($id)
    {
        try {
            User::where('id',$id)->firstOrFail()->delete();
            Session::flash('success','Data berhasil dihapus');
            return redirect()->route('admin');
        } catch(\Exception $e) {
            if ($e instanceOf ModelNotFoundException) {
                Session::flash('fail','Data tidak ditemukan');
            } else {
                report($e); // optional
                Session::flash('fail','Mohon dicoba beberapa saat lagi');
            }
            return redirect()->route('admin');
        }
    }
}
