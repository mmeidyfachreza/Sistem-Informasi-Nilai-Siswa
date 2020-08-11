<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jurusan_id')->unsigned();
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->cascadeOnDelete();
            $table->string('nama',50);
            $table->string('kode_label_prodi',50);
            $table->bigInteger('kode_jurusan_prodi');
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
        Schema::table('prodi', function (Blueprint $table) {
            $table->dropForeign(['jurusan_id']);
        });
        Schema::dropIfExists('prodis');
    }
}
