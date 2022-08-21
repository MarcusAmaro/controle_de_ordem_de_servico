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
        Schema::table('aparelhos', function (Blueprint $table) {
            $table->foreign('cli_id')->references('id')->on('clientes');
           

        });


        Schema::table('ordemservicos', function (Blueprint $table) {
            $table->foreign('cli_id')->references('id')->on('clientes');
            $table->foreign('apa_id')->references('id')->on('aparelhos');

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
};
