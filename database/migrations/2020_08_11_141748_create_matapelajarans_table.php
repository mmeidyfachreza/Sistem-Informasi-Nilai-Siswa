<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatapelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matapelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama',50);
            $table->integer('semester');
            $table->bigInteger('guru_id')->unsigned()->nullable();
            $table->foreign('guru_id')->references('id')->on('guru')->nullOnDelete();
            $table->string('jenis',50)->nullable();
            $table->string('sub_jenis',50)->nullable();
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
        Schema::table('matapelajaran', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
        });
        Schema::dropIfExists('matapelajaran');
    }
}
