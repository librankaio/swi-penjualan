<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table ->string('no_bon', 64)->charset('latin1')->collate('latin1_swedish_ci');
            $table ->date('tgl_bon');
            $table ->string('pengiriman', 128);
            $table ->string('phone', 13);
            $table ->string('pemesan', 128);
            $table ->string('nama', 128);
            $table ->string('alamat', 256);
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
        Schema::dropIfExists('penjualans');
    }
}
