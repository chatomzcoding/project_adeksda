<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTimlokus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timlokus', function (Blueprint $table) {
            $table->id();
            $table->string('nip',16);
            $table->string('nama',100);
            $table->string('jabatan');
            $table->string('no_sk')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('perihal')->nullable();
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
        Schema::dropIfExists('timlokus');
    }
}
