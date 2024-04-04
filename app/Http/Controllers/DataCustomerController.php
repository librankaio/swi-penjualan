<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class DataCustomerController extends Controller
{
    public function index()
    {
        $datas = Customer::all();
        return view('pages.customer',[
            'datas' => $datas,
        ]);
    }

    public function post(Request $request){
        Customer::create([
            'nama_pemesan' => $request->nama_pemesan,
            'nama_penerima' => $request->nama_penerima,
            'phone' => $request->hp,
            'alamat' => $request->alamat,
        ]);
        return redirect()->back()->with('success', 'Data berhasil di Simpan');
    }

    public function getedit(Customer $customer){
        return view('pages.customeredit',[
            'customer' => $customer,
        ]);
    }

    public function update(Customer $customer){
        Customer::where('id', '=', $customer->id)->update([
            'nama_pemesan' => request('nama_pemesan'),
            'nama_penerima' => request('nama_penerima'),
            'phone' => request('hp'),
            'alamat' => request('alamat'),
        ]);        
        return redirect()->route('customer')->with('success', 'Data berhasil di Update'); 
    }

    public function delete(Customer $customer){
        Customer::find($customer->id)->delete();
        return redirect()->route('customer')->with('success', 'Data berhasil di Delete');
    }
}
