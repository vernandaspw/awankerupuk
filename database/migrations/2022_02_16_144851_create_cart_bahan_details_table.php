<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartBahanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_bahan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('cart_bahan_supp_id')->constrained('cart_bahan_supps')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('setting_id')->nullable()->constrained('settings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('bahan_id')->nullable()->constrained('bahans')->onUpdate('cascade')->onDelete('set null');
            $table->bigInteger('qty')->default(0);
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
        Schema::dropIfExists('cart_bahan_details');
    }
}
