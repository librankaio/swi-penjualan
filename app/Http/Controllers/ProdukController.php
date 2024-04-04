<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $datas = Produk::all();
        return view('pages.produk',[
            'datas' => $datas,
        ]);
    }

    public function post(Request $request){
        Produk::create([
            'nama_brg' => $request->nama_brg,
            'hrgjual' => $request->harga,
            'satuan' => $request->satuan,
        ]);
        return redirect()->back()->with('success', 'Data berhasil di Simpan');
    }

    public function getedit(Produk $produk){
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

    public function  getproduk(Request $request){
        $nama_brg = $request->nama_brg;
        if($nama_brg == ''){
            $produks = Produk::select('id','nama_brg','hrgjual','satuan')->orderBy('nama_brg', 'asc')->limit(20)->get();
        }else{
            $produks = Produk::select('id','nama_brg','hrgjual','satuan')->where('nama_brg','=',$nama_brg)->limit(20)->get();
        }
        return json_encode($produks);
    }
}
