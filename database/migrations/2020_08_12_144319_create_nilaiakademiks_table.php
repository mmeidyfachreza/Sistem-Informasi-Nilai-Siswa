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
            $table->string('angkatan');
            $table->integer('semester');
            $table->bigInteger('siswa_id')->unsigned()->nullable();
            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnDelete();
            $table->string('nama_kelas',20)->nullable();
            $table->string('nama_jurusan',50)->nullable();
            $table->integer('nomor_kelas')->nullable();
            $table->float('sum_pengetahuan')->nullable();
            $table->float('sum_keterampilan')->nullable();
            $table->float('sum_nilai_akhir')->nullable();
            $table->float('avg_pengetahuan')->nullable();
            $table->float('avg_keterampilan')->nullable();
            $table->float('avg_nilai_akhir')->nullable();
            $table->string('avg_predikat',2)->nullable();
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
