<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiakademiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilaiakademik', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->integer('semester');
            $table->bigInteger('siswa_id')->unsigned()->nullable();
            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnDelete();
            $table->float('sum_pengetahuan');
            $table->float('sum_keterampilan');
            $table->float('sum_nilai_akhir');
            $table->float('avg_pengetahuan');
            $table->float('avg_keterampilan');
            $table->float('avg_nilai_akhir');
            $table->string('avg_predikat',2);
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
        Schema::table('nilaiakademik', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
        });
        Schema::dropIfExists('nilaiakademik');
    }
}
