<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesan_id')->nullable()->constrained('pesans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('setting_id')->nullable()->constrained('settings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('bahan_id')->nullable()->constrained('bahans')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pesan_details');
    }
}
