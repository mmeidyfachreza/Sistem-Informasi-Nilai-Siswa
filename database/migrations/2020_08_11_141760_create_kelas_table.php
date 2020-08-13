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
            $table->integer('nomor');
            $table->bigInteger('prodi_id')->unsigned()->nullable();
            $table->foreign('prodi_id')->references('id')->on('prodi')->nullOnDelete();
            $table->bigInteger('walikelas')->unsigned()->nullable();
            $table->foreign('walikelas')->references('id')->on('guru')->nullOnDelete();
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
            $table->dropForeign(['prodi_id']);
            $table->dropForeign(['walikelas']);
        });
        Schema::dropIfExists('kelas');
    }
}
