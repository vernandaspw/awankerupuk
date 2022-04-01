<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('no_telp', 50)->nullable();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 150);
            $table->string('provinsi', 50)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->longText('alamat', 50)->nullable();
            $table->string('bank', 50)->nullable();
            $table->string('an', 50)->nullable();
            $table->string('norek', 100)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('suppliers');
    }
}
