<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendakiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendakians', function (Blueprint $table) {
            $table->id('pendakian_id');
            $table->string('nama_kelompok');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->integer('jumlah_anggota');
            $table->enum('status',['pengajuan','diterima','ditolak','pengajuan_ulang']);
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
        Schema::dropIfExists('pendakians');
    }
}
