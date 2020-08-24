<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNilaiMapel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_mapel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nilaiakademik_id')->unsigned();
            $table->foreign('nilaiakademik_id')->references('id')->on('nilaiakademik')->cascadeOnDelete();
            $table->bigInteger('matapelajaran_id')->unsigned();
            $table->foreign('matapelajaran_id')->references('id')->on('matapelajaran')->cascadeOnDelete();
            $table->float('pengetahuan')->nullable();
            $table->float('keterampilan')->nullable();
            $table->float('nilai_akhir')->nullable();
            $table->string('predikat',2)->nullable();
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
        Schema::table('nilai_mapel', function (Blueprint $table) {
            $table->dropForeign(['nilaiakademik_id']);
            $table->dropForeign(['matapelajaran_id']);
        });
        Schema::dropIfExists('nilai_mapel');
    }
}
