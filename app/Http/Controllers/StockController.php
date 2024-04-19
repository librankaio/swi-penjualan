<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Stock;
use App\Models\Stock_d;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $barangs = Produk::all();
        $nobons = DB::select("select fgetcode('penjualan') as codebon");
        return view('pages.stock',[
            'barangs' => $barangs,
            'nobons' => $nobons
        ]);
    }

    public function post(Request $request){
        // dd($request->all());
        $nostocks = DB::select("select fgetcode('penjualan') as codestock");
        foreach($nostocks as $nostock){
            $no_stock = $nostock->codestock;
        }
        $checkexist = Stock::select('id','no_stock')->where('no_stock','=', $no_stock)->first();
        if($checkexist == null){
            Stock::create([
                'no_stock' => $no_stock,
                'tgl_stock' => $request->tgl_stock,
            ]);
            $idh_loop = Stock::select('id')->where('no_stock','=',$no_stock)->get();
            for($j=0; $j<sizeof($idh_loop); $j++){
                $idh = $idh_loop[$j]->id;
            }
    
            $countrows = sizeof($request->nama_brg_d);
            $count=0;
            for ($i=0;$i<sizeof($request->nama_brg_d);$i++){
                Stock_d::create([
                    'idh' => $idh,
                    'nama' => $request->nama_brg_d[$i],
                    'quantity' => $request->qty_d[$i],
                    'satuan' => $request->satuan_d[$i],
                ]);
                $count++;
            }
            // Tsob_h::where('no', '=', $request->nosob)->update([
            //     'exist_sj' => "Y",
            // ]);
            if($count == $countrows){
                return redirect()->back()->with('success', 'Data berhasil ditambahkan');
            }
        }
        return redirect()->back()->with('error', 'Nomor transaksi sudah ada!');
    }

    public function getedit(Stock $stock){
        // dd($stock);
        $stockds = stock_d::select('id','idh','nama','quantity','satuan')->where('idh','=',$stock->id)->get();
        $barangs = Produk::all();
        return view('pages.stockedit',[
            'stock' => $stock,
            'stockds' => $stockds,
            'barangs' => $barangs,
        ]);
    }

    public function update(Stock $stock){
        // dd(request()->all());
        // dd($penjualan->id);
        DB::delete('delete from stock_ds where idh = ?', [$stock->id] );
        Stock::where('id', '=', $stock->id)->update([
            'no_stock' => request('no_stock'),
            'tgl_stock' => request('tgl_stock'),
        ]);  
        $count=0;
        for ($i=0;$i<sizeof(request('nama_brg_d'));$i++){
            Stock_d::create([
                'idh' => $stock->id,
                'nama' => request('nama_brg_d')[$i],
                'quantity' => request('qty_d')[$i],
                'satuan' => request('satuan_d')[$i],
            ]);
            $count++;
        }
        
        return redirect()->route('stock')->with('success', 'Data berhasil di Update'); 
    }

    public function list(){
        $stocks = Stock::select('id','no_stock','tgl_stock')->orderBy('created_at', 'asc')->get();
        $stockds = Stock_d::select('id','idh','nama','quantity','satuan')->get();
        return view('pages.stocklist',[
            'stocks' => $stocks,
            'stockds' => $stockds
        ]);
    }

    public function delete(Stock $stock){
        Stock::find($stock->id)->delete();
        DB::delete('delete from stock_ds where idh = ?', [$stock->id] );
        return redirect()->route('produk')->with('success', 'Data berhasil di Delete');
    }
}
