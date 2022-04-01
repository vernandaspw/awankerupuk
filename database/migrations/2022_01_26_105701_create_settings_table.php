<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan', 150)->default('perusahaan');
            $table->string('no_telp', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->longText('alamat')->nullable();
            $table->decimal('pajak', 19, 4)->default(0)->nullable();
            $table->longText('tentang')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
