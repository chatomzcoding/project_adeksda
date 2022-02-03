<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToDokumenSpk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumen_spk', function (Blueprint $table) {
            $table->unsignedBigInteger('kontrak_id')->after('id');
            $table->foreign('kontrak_id')->references('id')->on('kontrak')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokumen_spk', function (Blueprint $table) {
            //
        });
    }
}
