<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('kebun', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kebun');
            $table->string('luas');
            $table->string('petak');
            $table->string('jenis_tebu');
            $table->string('kategori');
            $table->string('nama_sinder');
            $table->string('wilayah');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kebun');
    }
};
