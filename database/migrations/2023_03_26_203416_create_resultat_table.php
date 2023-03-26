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
        Schema::create('resultat', function (Blueprint $table) {
            $table->integer('idResultat', true);
            $table->integer('idCandidat')->index('fk_resultat_candidat');
            $table->integer('idTest');
            $table->decimal('score', 4);
            $table->integer('duree');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultat');
    }
};
