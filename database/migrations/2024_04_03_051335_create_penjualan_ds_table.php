<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_ds', function (Blueprint $table) {
            $table->id();
            $table ->string('nama', 128);
            $table ->decimal('quantity', $precision = 19, $scale = 6);
            $table ->decimal('harga', $precision = 19, $scale = 6);
            $table ->decimal('total', $precision = 19, $scale = 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_ds');
    }
}
