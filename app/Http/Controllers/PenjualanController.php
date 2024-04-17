<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Penjualan;
use App\Models\Penjualan_d;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $barangs = Produk::all();
        $customers = Customer::all();
        $nobons = DB::select("select fgetcode('penjualan') as codebon");
        return view('pages.penjualan',[
            'barangs' => $barangs,
            'customers' => $customers,
            'nobons' => $nobons
        ]);
    }

    public function post(Request $request){
        // dd($request->all());
        $nobons = DB::select("select fgetcode('penjualan') as codebon");
        foreach($nobons as $nobon){
            $no_bon = $nobon->codebon;
        }
        $checkexist = Penjualan::select('id','no_bon')->where('no_bon','=', $no_bon)->first();
        if($checkexist == null){
            Penjualan::create([
                'no_bon' => $no_bon,
                'tgl_bon' => $request->tgl_bon,
                'pengiriman' => $request->pengiriman,
                'phone' => $request->hp,
                'pemesan' => $request->pemesan,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'grandtot' => (float) str_replace(',', '', $request->grandtot),
            ]);
            $idh_loop = Penjualan::select('id')->where('no_bon','=',$no_bon)->get();
            for($j=0; $j<sizeof($idh_loop); $j++){
                $idh = $idh_loop[$j]->id;
            }
    
            $countrows = sizeof($request->nama_brg_d);
            $count=0;
            for ($i=0;$i<sizeof($request->nama_brg_d);$i++){
                Penjualan_d::create([
                    'idh' => $idh,
                    'nama' => $request->nama_brg_d[$i],
                    'quantity' => $request->qty_d[$i],
                    'satuan' => $request->satuan_d[$i],
                    'harga' => (float) str_replace(',', '', $request->hrgjual_d[$i]),
                    'total' => (float) str_replace(',', '', $request->total_d[$i]),
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

    public function getedit(Penjualan $penjualan){
        // dd($penjualan);
        $penjualands = Penjualan_d::select('id','idh','nama','quantity','harga','total','satuan',)->where('idh','=',$penjualan->id)->get();
        $barangs = Produk::all();
        $customers = Customer::all();
        return view('pages.penjualanedit',[
            'penjualan' => $penjualan,
            'penjualands' => $penjualands,
            'barangs' => $barangs,
            'customers' => $customers,
        ]);
    }

    public function update(Penjualan $penjualan){
        // dd(request()->all());
        // dd($penjualan->id);
        DB::delete('delete from penjualan_ds where idh = ?', [$penjualan->id] );
        Penjualan::where('id', '=', $penjualan->id)->update([
            'no_bon' => request('no_bon'),
            'tgl_bon' => request('tgl_bon'),
            'phone' => request('hp'),
            'pemesan' => request('pemesan'),
            'pengiriman' => request('pengiriman'),
            'alamat' => request('alamat'),
            'grandtot' => (float) str_replace(',', '', request('grandtot')),
        ]);  
        $count=0;
        for ($i=0;$i<sizeof(request('id_d'));$i++){
            if(request('deleted_item_d')[$i] != request('id_d')[$i]){
                Penjualan_d::create([
                    'idh' => $penjualan->id,
                    'nama' => request('nama_brg_d')[$i],
                    'quantity' => request('qty_d')[$i],
                    'satuan' => request('satuan_d')[$i],
                    'harga' => (float) str_replace(',', '', request('hrgjual_d')[$i]),
                    'total' => (float) str_replace(',', '', request('total_d')[$i]),
                ]);
                $count++;
            }
        }
        
        return redirect()->route('penjualan')->with('success', 'Data berhasil di Update'); 
    }

    public function list(){
        $penjualans = Penjualan::select('id','no_bon','tgl_bon','pengiriman','phone','pemesan','nama','alamat','grandtot',)->orderBy('created_at', 'asc')->get();
        $penjualands = Penjualan_d::select('id','idh','nama','quantity','harga','total','satuan',)->get();
        return view('pages.penjualanlist',[
            'penjualans' => $penjualans,
            'penjualands' => $penjualands
        ]);
    }

    public function delete(Penjualan $penjualan){
        Penjualan::find($penjualan->id)->delete();
        DB::delete('delete from penjualan_ds where idh = ?', [$penjualan->id] );
        return redirect()->route('produk')->with('success', 'Data berhasil di Delete');
    }
}
