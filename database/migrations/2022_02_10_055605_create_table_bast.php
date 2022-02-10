<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBast extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bast', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_selesai_pekerjaan');
            $table->integer('progress_pekerjaan');
            $table->date('tgl_permohonan_ceklis');
            $table->string('no_permohonan_ceklis');
            $table->date('tgl_surat_ppk');
            $table->date('tgl_surat_tim');
            $table->date('tgl_bast');
            $table->string('no_bast');
            $table->string('konsultan_pengawas')->nullable();
            $table->string('direktur')->nullable();
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
        Schema::dropIfExists('bast');
    }
}
