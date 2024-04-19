<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanStockController extends Controller
{
    public function index(){
        return view('pages.laporanstock');
        // $counters = Mcounter::select('id','code','name')->get();
        $privilage = session('privilage');
        if($privilage == 'ADM'){
            $counters = Mcounter::select('id','code','name')->get();
        }else if($privilage == null){
            $counters = Mcounter::select('id','code','name')->where('name','=',session('counter'))->get();
        }else{
            $counters = Mcounter::select('id','code','name')->where('name','=',session('counter'))->get();
        }
        return view('pages.Report.rlapperoutlet',[
            'counters' => $counters,
        ]);
    }

    public function post(Request $request)
    {
        $dtfr = $request->input('dtfr');
        $dtto = $request->input('dtto');
        $counter = $request->input('counter');

        $results = DB::select('CALL vpendapatanoutlet (?,?,?)', [$dtfr, $dtto,$counter]);
        // $counters = Mcounter::select('id','code','name')->get(); 
        $privilage = session('privilage');
        if($privilage == 'ADM'){
            $counters = Mcounter::select('id','code','name')->get();
        }else if($privilage == null){
            $counters = Mcounter::select('id','code','name')->where('name','=',session('counter'))->get();
        }else{
            $counters = Mcounter::select('id','code','name')->where('name','=',session('counter'))->get();
        }
        $saldo_awals = DB::select('select saldo from sldawaltoko where tgl = ? and counter = ?', [$dtfr, $counter] );
        $biayas = DB::select('select sum(total) as total from texpense_hs where tgl BETWEEN ? AND ?', [$dtfr,$dtto]);       

        return view('pages.Report.rlapperoutlet', [
            'results' => $results,
            'counters' => $counters,             
        ]);
    }
}
