<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HasilPklTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_pkl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pkl_siswa_id')->unsigned();
            $table->foreign('pkl_siswa_id')->references('id')->on('pkl_siswa')->cascadeOnDelete();
            $table->bigInteger('pkl_id')->unsigned();
            $table->foreign('pkl_id')->references('id')->on('pkl')->cascadeOnDelete();
            $table->integer('lamanya');
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
        Schema::table('hasil_pkl', function (Blueprint $table) {
            $table->dropForeign(['pkl_siswa_id']);
            $table->dropForeign(['pkl_id']);
        });
        Schema::dropIfExists('hasil_pkl');
    }
}