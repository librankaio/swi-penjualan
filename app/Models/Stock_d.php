<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_d extends Model
{
    use HasFactory;

    protected $fillable = [
        'idh',
        'nama',
        'quantity',
        'satuan',
    ];
}
