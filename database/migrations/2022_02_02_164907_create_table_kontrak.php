<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKontrak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak', function (Blueprint $table) {
            $table->id();
            $table->integer('masa_kontrak');
            $table->bigInteger('nilai_penawaran');
            $table->bigInteger('nilai_terkoreksi');
            $table->bigInteger('nilai_negosiasi');
            $table->bigInteger('nilai_pekerjaan');
            $table->integer('id_ketua')->nullable();
            $table->integer('id_sekretaris')->nullable();
            $table->integer('id_anggota')->nullable();
            $table->string('no_pengadaan')->nullable();
            $table->date('tgl_pengadaan')->nullable();
            $table->string('no_bahp')->nullable();
            $table->date('tgl_bahp')->nullable();
            $table->string('no_sppbj')->nullable();
            $table->date('tgl_sppbj')->nullable();
            $table->string('no_barpk')->nullable();
            $table->date('tgl_barpk')->nullable();
            $table->string('no_spk')->nullable();
            $table->date('tgl_spk')->nullable();
            $table->string('no_spmk')->nullable();
            $table->date('tgl_spmk')->nullable();
            $table->string('no_spl')->nullable();
            $table->date('tgl_spl')->nullable();
            $table->string('no_spp')->nullable();
            $table->date('tgl_spp')->nullable();
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
        Schema::dropIfExists('kontrak');
    }
}
