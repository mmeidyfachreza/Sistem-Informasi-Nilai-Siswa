<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raport', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('siswa_id')->unsigned()->nullable();
            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnDelete();
            $table->bigInteger('semester_id')->unsigned()->nullable();
            $table->foreign('semester_id')->references('id')->on('semester')->cascadeOnDelete();
            $table->bigInteger('matapelajaran_id')->unsigned()->nullable();
            $table->foreign('matapelajaran_id')->references('id')->on('matapelajaran')->cascadeOnDelete();
            $table->float('total_nilai_tugas');
            $table->float('nilai_uts');
            $table->float('nilai_uas');
            $table->string('bobot_nilai',2);
            $table->string('predikat',2);
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
        Schema::table('raport', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['semester_id']);
            $table->dropForeign(['matapelajaran_id']);
        });
        Schema::dropIfExists('raport');
    }
}
