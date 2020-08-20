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
            $table->integer('semester');
            $table->string('kelas');
            $table->string('prodi');
            $table->string('jurusan');
            $table->string('no_kelas');
            $table->bigInteger('nilaiakademik_id')->unsigned()->nullable();
            $table->foreign('nilaiakademik_id')->references('id')->on('nilaiakademik')->cascadeOnDelete();
            $table->bigInteger('pkl_siswa_id')->unsigned()->nullable();
            $table->foreign('pkl_siswa_id')->references('id')->on('pkl_siswa')->cascadeOnDelete();
            $table->bigInteger('ekskul_siswa_id')->unsigned()->nullable();
            $table->foreign('ekskul_siswa_id')->references('id')->on('ekskul_siswa')->cascadeOnDelete();
            $table->integer('peringkat');
            $table->string('cat_akademik');
            $table->integer('sakit');
            $table->integer('izin');
            $table->integer('tanpa_ket');
            $table->enum('kenaikan_kelas',['Naik','Tidak Naik']);
            $table->string('ke_kelas');
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
        });
        Schema::dropIfExists('raport');
    }
}
