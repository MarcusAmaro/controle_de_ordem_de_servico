<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordemservicos', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('ord_relatado');
            $table->longText('ord_relatado_tecnico');
            $table->string('ord_situacao');
            $table->string('ord_aberto');
            $table->integer('cli_id')->unsigned();
            $table->integer('apa_id')->unsigned(); 
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
        Schema::dropIfExists('ordemservicos');
    }
};
