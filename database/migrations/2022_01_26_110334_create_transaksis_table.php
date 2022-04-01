<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('subtotal', 19, 4)->default(0);
            $table->decimal('total_pembayaran', 19, 4)->default(0);
            $table->foreignId('transaksi_metode_id')->nullable()->constrained('transaksi_metodes')->onUpdate('cascade')->onDelete('SET NULL');
            $table->enum('status_bayar', ['blmbayar', 'proses', 'sdhbayar'])->default('blmbayar');
            $table->enum('status_transaksi', ['pembayaran', 'dikemas', 'dikirim', 'diterima', 'selesai', 'batal'])->default('pembayaran');
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
        Schema::dropIfExists('transaksis');
    }
}
