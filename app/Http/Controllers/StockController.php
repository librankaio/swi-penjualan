<?php

namespace App\Http\Controllers;

use App\Models\Produk;
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
}
