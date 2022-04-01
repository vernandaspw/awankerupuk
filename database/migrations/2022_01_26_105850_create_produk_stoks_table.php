<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_stoks', function (Blueprint $table) {
            $table->id();
            $table->enum('posisi', ['gudang', 'toko']);
            $table->enum('status', ['masuk', 'keluar', 'pindah']);
            $table->foreignId('produk_id')->nullable()->constrained('produks')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('qty')->default(0);
            $table->enum('isPindah', ['ketoko', 'kegudang'])->nullable();
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('produk_stoks');
    }
}
