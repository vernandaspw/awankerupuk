<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanBahanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_bahan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('pesan_bahan_id')->constrained('pesan_bahans')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_bahan')->nullable();
            $table->decimal('harga', 19, 4)->default(0);
            $table->bigInteger('qty')->default(0);
            $table->decimal('total_harga', 19, 4)->default(0);

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
        Schema::dropIfExists('pesan_bahan_details');
    }
}
