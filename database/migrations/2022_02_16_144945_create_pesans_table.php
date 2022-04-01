<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('setting_id')->nullable()->constrained('settings')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('biaya_antar', 19, 4)->default(0);
            $table->decimal('total_harga', 19, 4)->default(0);
            $table->decimal('total_pembayaran', 19, 4)->default(0);
            $table->enum('metode', ['tunai', 'cod', 'transfer'])->nullable();
            $table->enum('status_bayar', ['menunggu', 'blmbayar', 'sdhbayar', 'batal'])->nullable();
            $table->enum('status', ['menunggu', 'harga', 'dikemas', 'dikirim', 'diterima', 'selesai', 'batal'])->nullable();
            $table->longText('catatan')->nullable();
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
        Schema::dropIfExists('pesans');
    }
}
