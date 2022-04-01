<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama', 190)->nullable();
            $table->string('img_url', 150)->nullable();
            $table->foreignId('bahan_kategori_id')->nullable()->constrained('bahan_kategoris')->onUpdate('cascade')->onDelete('SET NULL');
            $table->foreignId('bahan_brand_id')->nullable()->constrained('bahan_brands')->onUpdate('cascade')->onDelete('SET NULL');
            $table->foreignId('satuan_id')->nullable()->constrained('satuans')->onUpdate('cascade')->onDelete('SET NULL');
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
        Schema::dropIfExists('bahans');
    }
}
