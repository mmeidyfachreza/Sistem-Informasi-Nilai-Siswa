<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HasilEkskulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_ekskul', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ekskul_siswa_id')->unsigned();
            $table->foreign('ekskul_siswa_id')->references('id')->on('ekskul_siswa')->cascadeOnDelete();
            $table->bigInteger('ekstrakurikuler_id')->unsigned();
            $table->foreign('ekstrakurikuler_id')->references('id')->on('ekstrakurikuler')->cascadeOnDelete();
            $table->text('keterangan')->nullable();
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
        Schema::table('hasil_ekskul', function (Blueprint $table) {
            $table->dropForeign(['ekskul_siswa_id']);
            $table->dropForeign(['ekstrakurikuler_id']);
        });
        Schema::dropIfExists('hasil_ekskul');
    }
}