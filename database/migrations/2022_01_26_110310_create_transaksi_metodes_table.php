<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiMetodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_metodes', function (Blueprint $table) {
            $table->id();
            $table->enum('metode', ['cod', 'transfer']);
            $table->string('keterangan', 50)->nullable();
            $table->string('an', 50)->nullable();
            $table->string('norek', 100)->nullable();
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
        Schema::dropIfExists('transaksi_metodes');
    }
}
