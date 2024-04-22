<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPenjualanController extends Controller
{
    public function index(){
        return view('pages.laporanpenjualan');
    }

    public function post(Request $request)
    {
        $dtfr = $request->input('dtfr');
        $dtto = $request->input('dtto');

        // $results = DB::select('select no_bon, tgl_bon, pengiriman, pemesan, phone, nama, quantity, total from vpenjualan where tgl_bon BETWEEN ? AND ?', [$dtfr, $dtto ]);
        $results =  DB::table('vpenjualan')->whereBetween('tgl_bon', [$dtfr, $dtto])->get();
             
        // dd($request);
        return view('pages.laporanpenjualan', [
            'results' => $results,       
        ]);
    }
}
