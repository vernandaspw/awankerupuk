<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 190)->nullable();
            $table->string('img_url', 150)->nullable();
            $table->foreignId('produk_kategori_id')->nullable()->constrained('produk_kategoris')->onUpdate('cascade')->onDelete('SET NULL');
            $table->foreignId('produk_brand_id')->nullable()->constrained('produk_brands')->onUpdate('cascade')->onDelete('SET NULL');
            $table->decimal('harga_pokok', 19, 4)->default(0);
            $table->decimal('harga_jual', 19, 4)->default(0);
            $table->longText('keterangan')->nullable();
            $table->bigInteger('stok_gudang')->default(0);
            $table->bigInteger('stok_toko')->default(0);
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
        Schema::dropIfExists('produks');
    }
}
