<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartBahanSuppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_bahan_supps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('cart_bahan_id')->nullable()->constrained('cart_bahans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('setting_id')->nullable()->constrained('settings')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('metode', ['tunai', 'cod', 'transfer'])->nullable();
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
        Schema::dropIfExists('cart_bahan_supps');
    }
}
