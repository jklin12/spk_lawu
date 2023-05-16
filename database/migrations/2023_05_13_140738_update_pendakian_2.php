<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePendakian2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendakians', function (Blueprint $table) {

            $table->renameColumn('nama_kelompok','ketua_nama');
            $table->date('ketua_tgl_lahir')->after('nama_kelompok');
            $table->string('ketua_tempat_lahir')->after('nama_kelompok');
            $table->string('ketua_telepon')->after('nama_kelompok');
            $table->string('ketua_jenis_kelamin')->after('nama_kelompok');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
