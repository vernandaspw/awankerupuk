<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bahans_id')->nullable()->constrained('bahans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('office_id')->nullable()->constrained('offices')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('rating')->nullable();
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
        Schema::dropIfExists('bahan_rates');
    }
}
