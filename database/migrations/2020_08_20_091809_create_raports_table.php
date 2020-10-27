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
            $table->bigInteger('nilaiakademik_id')->unsigned()->nullable();
            $table->foreign('nilaiakademik_id')->references('id')->on('nilaiakademik')->cascadeOnDelete();
            $table->bigInteger('pkl_siswa_id')->unsigned()->nullable();
            $table->foreign('pkl_siswa_id')->references('id')->on('pkl_siswa')->cascadeOnDelete();
            $table->bigInteger('ekskul_siswa_id')->unsigned()->nullable();
            $table->foreign('ekskul_siswa_id')->references('id')->on('ekskul_siswa')->cascadeOnDelete();
            $table->integer('peringkat')->nullable();
            $table->string('cat_akademik')->nullable();
            $table->integer('sakit')->nullable();
            $table->integer('izin')->nullable();
            $table->integer('tanpa_ket')->nullable();
            $table->string('keterangan_kenaikan',150)->nullable();
            $table->bigInteger('kelas_id')->unsigned()->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas')->cascadeOnDelete();
            $table->bigInteger('guru_id')->unsigned()->nullable();
            $table->foreign('guru_id')->references('id')->on('guru')->cascadeOnDelete();
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
            $table->dropForeign(['nilaiakademik_id']);
            $table->dropForeign(['pkl_siswa_id']);
            $table->dropForeign(['ekskul_siswa_id']);
            $table->dropForeign(['kelas_id']);
            $table->dropForeign(['guru_id']);
        });
        Schema::dropIfExists('raport');
    }
}
