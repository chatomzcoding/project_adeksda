<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDatapokok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datapokok', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instansi');
            $table->string('alamat_instansi');
            $table->string('kode_pos');
            $table->string('no_keputusan');
            $table->date('tgl_keputusan');
            $table->integer('id_ppk')->nullable();
            $table->integer('id_ppTK')->nullable();
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
        Schema::dropIfExists('datapokok');
    }
}
