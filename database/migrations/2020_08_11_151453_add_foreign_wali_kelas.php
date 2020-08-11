<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignWaliKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->bigInteger('walikelas_id')->unsigned()->nullable()->after('prodi_id');
            $table->foreign('walikelas_id')->references('id')->on('walikelas')->cascadeOnDelete();
        });

        Schema::table('walikelas', function (Blueprint $table) {
            $table->bigInteger('kelas_id')->unsigned()->nullable()->after('idguru');
            $table->foreign('kelas_id')->references('id')->on('kelas')->cascadeOnDelete();
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
            $table->dropForeign(['kelas_id']);
        });

        Schema::table('walikelas', function (Blueprint $table) {
            
            $table->dropForeign(['walikelas_id']);
        });
    }
}
