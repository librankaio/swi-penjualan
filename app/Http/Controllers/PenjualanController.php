<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $barangs = Produk::all();
        return view('pages.penjualan',[
            'barangs' => $barangs
        ]);
    }

    public function post(Request $request){
        Penjualan::create([
            'nama_brg' => $request->nama_brg,
            'hrgjual' => $request->harga,
            'satuan' => $request->satuan,
        ]);
        return redirect()->back()->with('success', 'Data berhasil di Simpan');
    }

    public function getedit(Penjualan $produk){
        return view('pages.produkedit',[
            'produk' => $produk,
        ]);
    }

    public function update(Produk $produk){
        Produk::where('id', '=', $produk->id)->update([
            'nama_brg' => request('nama_brg'),
            'hrgjual' => (float) str_replace(',', '', request('harga')),
            'satuan' => request('satuan'),
        ]);        
        return redirect()->route('produk')->with('success', 'Data berhasil di Update'); 
    }

    public function delete(Produk $produk){
        Produk::find($produk->id)->delete();
        return redirect()->route('produk')->with('success', 'Data berhasil di Delete');
    }
}
