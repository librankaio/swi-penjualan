<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_bon',
        'tgl_bon',
        'pengiriman',
        'phone',
        'pemesan',
        'nama',
        'alamat',
        'grandtot',
    ];
}
