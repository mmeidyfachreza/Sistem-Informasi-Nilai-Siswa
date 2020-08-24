<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('nisn');
            $table->string('nama',100);
            $table->string('tempat_lahir',45);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->enum('jenis_kelamin',['Laki-laki','Perempuan']);
            $table->string('nohp',20);
            $table->bigInteger('user_id')->unsigned()->nullable()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->bigInteger('kelas_id')->unsigned()->nullable()->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas')->nullOnDelete();
            $table->bigInteger('jurusan_id')->unsigned()->nullable()->nullable();
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->nullOnDelete();
            $table->date('tanggal_masuk');
            $table->string('angkatan_thn',4);
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
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['kelas_id']);
            $table->dropForeign(['jurusan_id']);
        });
        Schema::dropIfExists('siswa');
    }
}
