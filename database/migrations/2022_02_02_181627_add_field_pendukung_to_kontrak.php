<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldPendukungToKontrak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kontrak', function (Blueprint $table) {
            $table->unsignedBigInteger('timlokus_id')->nullable();
            $table->unsignedBigInteger('pekerjaan_id')->nullable();
            $table->unsignedBigInteger('perusahaan_id')->nullable();
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
