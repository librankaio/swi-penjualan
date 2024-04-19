<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_ds', function (Blueprint $table) {
            $table->id();
            $table->integer('idh');
            $table ->string('nama', 128);
            $table ->decimal('quantity', $precision = 19, $scale = 6);
            $table ->string('satuan', 64);
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
        Schema::dropIfExists('stock_ds');
    }
}
