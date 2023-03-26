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
        Schema::create('reponse_resultat', function (Blueprint $table) {
            $table->integer('idResultat');
            $table->integer('idReponce')->index('fk_reponce_resultat_reponse_0');

            $table->primary(['idResultat', 'idReponce']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reponse_resultat');
    }
};
