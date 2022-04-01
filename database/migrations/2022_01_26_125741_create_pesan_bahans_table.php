<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanBahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_bahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_telp')->nullable();
            $table->longText('alamat')->nullable();
            $table->decimal('biaya_antar', 19, 4)->default(0);
            $table->decimal('total_bayar', 19, 4)->default(0);
            $table->enum('status', ['menunggu', 'harga', 'blmbayar', 'sdhbayar', 'dikemas', 'dikirim', 'diterima', 'selesai', 'batal']);
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
        Schema::dropIfExists('pesan_bahans');
    }
}
