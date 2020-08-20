<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EkskulSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekskul_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('tahun',4);
            $table->integer('semester');
            $table->bigInteger('siswa_id')->unsigned()->nullable();
            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnDelete();
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
        Schema::table('ekskul_siswa', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
        });
        Schema::dropIfExists('ekskul_siswa');
    }
}
