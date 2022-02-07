<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldAdendumToKontrak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kontrak', function (Blueprint $table) {
            $table->string('no_adendum')->nullable();
            $table->date('tgl_adendum')->nullable();
            $table->integer('nilai')->nullable();
            $table->integer('masakontrak_adendum')->nullable();
            $table->date('tgl_akhir_kontrak')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kontrak', function (Blueprint $table) {
            //
        });
    }
}
