<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePekerjaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kegiatan');
            $table->string('kode_tender');
            $table->string('nama_kegiatan');
            $table->string('sub_kegiatan');
            $table->string('nama_paket');
            $table->string('kecamatan');
            $table->string('kode_belanja');
            $table->string('sumber_dana');
            $table->string('tahun_anggaran');
            $table->string('jenis_pekerjaan');
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
        Schema::dropIfExists('pekerjaan');
    }
}
