<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterLogistiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_logistiks', function (Blueprint $table) {
            $table->id('master_logistik_id');
            $table->enum('master_logistik_jenis',['Kelompok','Individu']);
            $table->tinyInteger('master_logistik_wajib');
            $table->string('master_logistik_nama');
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
        Schema::dropIfExists('master_logistiks');
    }
}
