<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taksasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sinder');
            $table->string('nama_kebun');
            $table->string('id_kebun');
            $table->string('mandor');
            $table->string('faktor_leng')->nullable();
            $table->string('batang_per_meter')->nullable();
            $table->string('batang_per_row')->nullable();
            $table->string('batang_per_ha')->nullable();
            $table->string('tinggi_ini')->nullable();
            $table->string('tinggi_tebang')->nullable();
            $table->string('diameter_batang')->nullable();
            $table->string('berat_per_meter')->nullable();
            $table->string('hit')->nullable();
            $table->string('pandangan')->nullable();
            $table->string('per_hit')->nullable();
            $table->string('kui')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taksasi');
    }
};
