<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id('id_anggota');
            $table->integer('pendakian_id');
            $table->string('nama_anggota');
            $table->string('alamat_anggota');
            $table->enum('jenis_kelamin_anggota',['Laki-laki','Perempuan']);
            $table->string('tempat_lahir_anggota');
            $table->date('tanggal_lahir_anggota');
            $table->date('telepon_anggota');
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
        Schema::dropIfExists('anggotas');
    }
}
