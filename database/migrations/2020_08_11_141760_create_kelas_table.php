<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor');
            $table->bigInteger('jurusan_id')->unsigned()->nullable();
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->nullOnDelete();
            $table->bigInteger('guru_id')->unsigned()->nullable();
            $table->foreign('guru_id')->references('id')->on('guru')->nullOnDelete();
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
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign(['jurusan_id']);
            $table->dropForeign(['guru_id']);
        });
        Schema::dropIfExists('kelas');
    }
}
